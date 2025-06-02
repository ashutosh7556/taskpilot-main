<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasks;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Show all tasks (for users).
     */
    public function create()
    {
        $tasks = Tasks::latest()->get();
        return view('Task', compact('tasks'));
    }

    /**
     * Store a new task by user.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Tasks::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Task created successfully.');
    }

    /**
     * Assign task by admin.
     */
    public function assignTask(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);

        Tasks::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
            'assigned_by' => Auth::guard('admin')->id(),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Task assigned successfully.');
    }

    /**
     * Update a task.
     */
    public function taskupdate(Request $request, $id)
    {
        $task = Tasks::findOrFail($id);

        if ($request->isMethod('put')) {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
            ]);

            $task->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            return redirect()->route('user.dashboard')->with('success', 'Task updated successfully.');
        }

        $tasks = Tasks::latest()->get();
        return view('Task', compact('task', 'tasks'));
    }

    /**
     * Delete a task.
     */
    public function destroy($id)
    {
        $task = Tasks::findOrFail($id);
        $task->delete();

        if (request()->ajax()) {
            return response()->json(['message' => 'Task deleted successfully.']);
        }

        return redirect()->route('user.dashboard')->with('success', 'Task deleted successfully.');
    }

    /**
     * Show user dashboard with all tasks.
     */
    public function taskdashboard()
    {
        $tasks = Tasks::latest()->get();
        return view('dashboard', compact('tasks'));
    }

    /**
     * User takes a task.
     */
    public function takeTask(Request $request)
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'status' => 'required|in:in_progress,done',
        ]);

        $task = Tasks::findOrFail($request->task_id);
        $task->status = $request->status;
        $task->user_id = auth()->id();
        $task->save();

        $message = $request->status === 'done'
            ? 'Task is done successfully.'
            : 'Task in progress.';

        return response()->json(['message' => $message]);
    }

    /**
     * Load take task view.
     */
    public function loadTakeTask($id)
    {
        $task = Tasks::findOrFail($id);
        return view('takeTask', compact('task'));
    }

    /**
     * Admin Dashboard - load users and taken tasks.
     */
    public function adminDashboard()
    {
        $users = User::with('tasks')->get();
        $takenTasks = Tasks::whereNotNull('user_id')->latest()->get();

        return view('admin.dashboard', compact('users', 'takenTasks'));
    }
}
