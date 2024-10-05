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
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'nullable|string|max:250',
            'editSelectTaskStatus' => 'required|exists:categories,id',
            'subtasks' => 'array',
            'subtasks.*' => 'string|max:100',
        ]);

        $task->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category_id' => $validated['editSelectTaskStatus'],
        ]);

        $existingSubtasks = $task->subtasks->pluck('title', 'id')->toArray();

        $newSubtasks = $request->input('subtasks', []);

        $subtasksToDelete = array_diff($existingSubtasks, $newSubtasks);

        $subtasksToCreate = array_diff($newSubtasks, $existingSubtasks);

        if (!empty($subtasksToDelete)) {
            $task->subtasks()->whereIn('title', array_values($subtasksToDelete))->delete();
        }

        foreach ($subtasksToCreate as $subtaskName) {
            Subtask::create([
                'title' => $subtaskName,
                'task_id' => $task->id,
            ]);
        }

        return redirect()->route('home')->with('success', 'Task updated successfully!');
    }

    public function destroy(Task $task)
    {

        $this->authorize('edit-task', $task);

        $task->delete();

        return redirect()->route('home');
    }
}
