<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Dashboard;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index(Task $task = null)
    {
        if (!Auth::check()) {
            return view('welcome', [
                'dashboards' => null,
                'currentDashboardId' => null,
                'selectedTask' => null
            ]);
        }

        $dashboards = Auth::user()->dashboards()->with(['categories.tasks'])->get();

        $dashboards->each(function ($dashboard) {
            $dashboard->categories = $dashboard->categories->sortByDesc(function ($category) {
                return $category->tasks->count();
            });
        });


        $currentDashboardId = session('current_dashboard_id', $dashboards->first()->id ?? null);

        session(['current_dashboard_id' => $currentDashboardId]);

        if ($task && !Gate::allows('edit-task', $task)) {
            abort(403, 'Unauthorized action.');
        }

        $selectedTask = $task ? Task::with('subtasks')->find($task->id) : null;

        return view('welcome', [
            'dashboards' => $dashboards,
            'currentDashboardId' => $currentDashboardId,
            'selectedTask' => $selectedTask
        ]);
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

        $existingCategories = $dashboard->categories->pluck('name', 'id')->toArray();

        $newCategories = $request->input('categories', []);

        $categoriesToDelete = array_diff($existingCategories, $newCategories);
        $categoriesToCreate = array_diff($newCategories, $existingCategories);

        if (!empty($categoriesToDelete)) {
            $dashboard->categories()->whereIn('name', array_values($categoriesToDelete))->delete();
        }

        foreach ($categoriesToCreate as $categoryName) {
            Category::create([
                'name' => $categoryName,
                'dashboard_id' => $dashboard->id,
            ]);
        }

        return redirect()->route('home');
    }

    public function destroy()
    {
        $dashboard = session('current_dashboard_id');

        $this->authorize('delete-dashboard', $dashboard);

        $dashboard->delete();

        return redirect()->route('home');
    }
}
