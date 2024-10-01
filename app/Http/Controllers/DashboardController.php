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
        if (!Auth::check()) {
            return view('welcome', [
                'dashboards' => null
            ]);
        }
        $dashboards = Auth::user()->dashboards;

        $currentDashboardId = session('current_dashboard_id', $dashboards->first()->id ?? null);

        session(['current_dashboard_id' => $currentDashboardId]);

        return view('welcome', compact('dashboards', 'currentDashboardId'));
    }

    public function selectDashboard($id)
    {
        session(['current_dashboard_id' => $id]);

        return redirect()->back();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'boardName' => 'required|string|max:30',
            'categories' => 'array',
            'categories.*' => 'string|max:30'
        ]);

        // Create a new dashboard for the authenticated user
        $dashboard = Dashboard::create([
            'name' => $validated['boardName'],
            'user_id' => Auth::id(),
        ]);

        // Add categories to the dashboard
        foreach ($request->input('categories', []) as $categoryName) {
            Category::create([
                'name' => $categoryName,
                'dashboard_id' => $dashboard->id,
            ]);
        }

        session(['current_dashboard_id' => $dashboard->id]);

        return redirect()->route('home');
    }

    public function update(Request $request)
    {
        $dashboardId = session('current_dashboard_id');
        $dashboard = Dashboard::findOrFail($dashboardId);

        $this->authorize('edit-dashboard', $dashboard);

        $validated = $request->validate([
            'boardName' => 'required|string|max:30',
            'categories' => 'array',
            'categories.*' => 'string|max:30'
        ]);


        $dashboard->update([
            'name' => $validated['boardName'],
        ]);

        $dashboard->categories()->delete();

        foreach ($request->input('categories', []) as $categoryName) {
            Category::create([
                'name' => $categoryName,
                'dashboard_id' => $dashboard->id,
            ]);
        }

        return redirect()->route('home');
    }

    public function destroy(Dashboard $dashboard)
    {
        $this->authorize('delete-dashboard', $dashboard);

        $dashboard->delete();

        return redirect()->route('home');
    }
}
