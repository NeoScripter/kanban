<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $dashboards = Auth::user()->dashboards;

        $currentDashboardId = session('current_dashboard_id', $dashboards->first()->id ?? null);

        return view('welcome', compact('dashboards', 'currentDashboardId'));
    }

    public function selectDashboard($id)
    {
        session(['current_dashboard_id' => $id]);

        return redirect()->back();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:30',
            'categories' => 'array', // Categories must be an array
            'categories.*' => 'string|max:30' // Each category must be a string
        ]);

        // Create a new dashboard for the authenticated user
        $dashboard = Dashboard::create([
            'name' => $request->input('name'),
            'user_id' => Auth::id(),
        ]);

        // Add categories to the dashboard
        foreach ($request->input('categories') as $categoryName) {
            Category::create([
                'name' => $categoryName,
                'dashboard_id' => $dashboard->id,
            ]);
        }

        return redirect()->route('dashboard.index');
    }

    public function destroy(Dashboard $dashboard)
    {
        $this->authorize('delete', $dashboard);

        $dashboard->delete();

        return redirect()->route('dashboard.index')->with('success', 'Dashboard deleted successfully!');
    }
}
