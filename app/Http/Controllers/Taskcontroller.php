<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    public function create()
    {
        return view('Task');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Task created successfully.');
    }

    public function taskupdate(Request $request, $id)
    {
        if ($request->isMethod('put')) {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
            ]);

            $task = Task::findOrFail($id);
            $task->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            return redirect()->route('user.dashboard')->with('success', 'Task updated successfully.');
        }

        $task = Task::findOrFail($id);
        return view('Task', compact('task'));
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('user.dashboard')->with('success', 'Task deleted successfully.');
    }

    public function taskdashboard()
    {
        $tasks = Task::latest()->get();
        return view('dashboard', compact('tasks'));
    }

    public function taketask(Request $request)
    {
        $task = Task::findOrFail();

        $task->status = $request->status; // Example: 'in_progress', 'done', 'pending'
        $task->save();

        return redirect()->route('user.dashboard')->with('success', 'Task status updated.');
    }
}






