<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS (only one version) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
        <form method="POST" action="{{ route('logout2') }}">
            @csrf
            <button class="btn btn-outline-light btn-sm">Logout</button>
        </form>
    </div>
</nav>

     @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif


<div class="container mt-5">
    <h3>Welcome, {{ Auth::guard('admin')->user()?->name ?? 'Admin' }}</h3>

    {{-- Stats Cards --}}
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3" role="button" data-bs-toggle="modal" data-bs-target="#usersModal" style="cursor:pointer;">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text">{{ $users->count() }}</p>
                </div>
            </div>

        </div>


        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Tasks Assigned</h5>
                    <p class="card-text">{{ $takenTasks->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Assign Task Form --}}
    <div class="mt-5">
        <h4>Assign Task to User</h4>
        <form method="POST" action="{{ route('admin.assignTask') }}">
            @csrf
            <div class="mb-3">
                <label for="user_id" class="form-label">Select User</label>
                <select name="user_id" id="user_id" class="form-select" required>
                    @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Task Title</label>
                <input type="text" name="title" id="title" class="form-control" required />
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Task Description</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Assign Task</button>
        </form>
    </div>

    {{-- Assigned Tasks Table --}}
    <div class="mt-5">
        <h4>Assigned Tasks</h4>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Task</th>
                <th>Description</th>
                <th>Assigned To</th>
                <th>Status</th>
                <th>Assigned By</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($takenTasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ $task->user?->name ?? 'N/A' }}</td>
                <td>
                    @if ($task->status === 'done')
                    <span class="badge bg-success">Done</span>
                    @elseif ($task->status === 'in_progress')
                    <span class="badge bg-warning text-dark">In Progress</span>
                    @else
                    <span class="badge bg-secondary">Pending</span>
                    @endif
                </td>
                <td>{{ $task->assignedByAdmin?->name ?? 'N/A' }}</td>
                <td>{{ $task->created_at->format('Y-m-d H:i') }}</td>
                <td>
                    <!-- Edit Button -->
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editTaskModal{{ $task->id }}">
                        <i class="fa-solid fa-user-pen"></i>
                    </button>

                    <!-- Delete Form -->
                    <form method="POST" action="{{ route('admin.task.delete', $task->id) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this task?');">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>

            <!-- Edit Modal -->
            <div
                class="modal fade" id="editTaskModal{{ $task->id }}" tabindex="-1" aria-labelledby="editTaskModalLabel{{ $task->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('admin.task.update', $task->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="modal-header">
                                <h5 class="modal-title" id="editTaskModalLabel{{ $task->id }}">
                                    Edit Task
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="title{{ $task->id }}" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title{{ $task->id }}" name="title" value="{{ $task->title }}" required
                                    />
                                </div>
                                <div class="mb-3">
                                    <label for="description{{ $task->id }}" class="form-label"
                                    >Description</label
                                    >
                                    <textarea
                                        class="form-control"
                                        id="description{{ $task->id }}"
                                        name="description"
                                    >{{ $task->description }}</textarea>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button
                                    type="button"
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal"
                                >
                                    Cancel
                                </button>
                                <button type="submit" class="btn btn-success">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <tr>
                <td colspan="7" class="text-center">No tasks assigned yet.</td>
            </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap JS Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>



@include('usersmodel')

</body>
</html>
