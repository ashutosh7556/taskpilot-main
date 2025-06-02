<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tasks;

class AdminController extends Controller
{
    // Show admin dashboard
    public function adminDashboard()
    {
        $users = User::with('tasks')->get();
        $takenTasks = Tasks::all();

        return view('admindashboard', compact('users', 'takenTasks'));
    }

    // Update task (from admin panel)
    public function updateTask(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $task = Tasks::findOrFail($id);
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Task updated successfully.');
    }

    // Delete task (from admin panel)
    public function deleteTask($id)
    {
        $task = Tasks::findOrFail($id);
        $task->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Task deleted successfully.');
    }


    public function show()
    {
        $users = User::all();           // fetch all users
        $takenTasks = Tasks::all();      // your tasks data
        // pass data to view
        return view('admin.dashboard', compact('users', 'takenTasks'));
    }


}
