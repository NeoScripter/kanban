<?php

namespace App\Http\Controllers;

use App\Models\Subtask;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'taskName' => 'required|string|max:30',
            'subtasks' => 'array',
            'taskDescription' => 'max:250',
            'subtasks.*' => 'string|max:30',
            'selectTaskStatus' => 'required|exists:categories,id'
        ]);

        $task = Task::create([
            'title' => $validated['taskName'],
            'description' => $validated['taskDescription'],
            'category_id' => $validated['selectTaskStatus'],
        ]);

        foreach ($request->input('subtasks', []) as $subtaskName) {
            Subtask::create([
                'title' => $subtaskName,
                'task_id' => $task->id,
            ]);
        }

        return redirect()->route('home');
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'selectEditingTaskStatus' => 'required|exists:categories,id',
            'subtasks' => 'array'
        ]);

        $task->update([
            'category_id' => $validated['selectEditingTaskStatus'],
        ]);

        $completedSubtaskIds = $request->input('subtasks', []);

        $task->subtasks()->update(['is_completed' => false]);

        if (!empty($completedSubtaskIds)) {
            $task->subtasks()->whereIn('id', $completedSubtaskIds)->update(['is_completed' => true]);
        }

        return redirect()->route('home')->with('success', 'Task updated successfully!');
    }

    public function edit(Request $request, Task $task)
    {
        // Step 1: Validate the incoming request
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'nullable|string|max:250',
            'editSelectTaskStatus' => 'required|exists:categories,id',
            'subtasks' => 'array',
            'subtasks.*' => 'string|max:100',
        ]);

        // Step 2: Update the main task details
        $task->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category_id' => $validated['editSelectTaskStatus'],
        ]);

        // Step 3: Get the existing subtasks for the task
        $existingSubtasks = $task->subtasks->pluck('title', 'id')->toArray();

        // Step 4: Get the new subtask titles from the input
        $newSubtasks = $request->input('subtasks', []);

        // Step 5: Calculate subtasks to delete (existing but not in the new input)
        $subtasksToDelete = array_diff($existingSubtasks, $newSubtasks);

        // Step 6: Calculate subtasks to create (new input but not in existing)
        $subtasksToCreate = array_diff($newSubtasks, $existingSubtasks);

        // Step 7: Delete subtasks that are no longer in the input
        if (!empty($subtasksToDelete)) {
            $task->subtasks()->whereIn('title', array_values($subtasksToDelete))->delete();
        }

        // Step 8: Create new subtasks that are not in the existing list
        foreach ($subtasksToCreate as $subtaskName) {
            Subtask::create([
                'title' => $subtaskName,
                'task_id' => $task->id,
            ]);
        }

        // Redirect back to the homepage with a success message
        return redirect()->route('home')->with('success', 'Task updated successfully!');
    }
}
