<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TaskPilot Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand">TaskPilot</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.logout') }}">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container mt-4">
    @auth
    <h2 class="mb-3">Welcome, {{ Auth::user()->name }}</h2>

    @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
    <div class="mb-4">
        <a href="{{ route('Tasks.create') }}" class="btn btn-primary">+ Create New Task</a>
    </div>
    @endif
    <h3 class="mb-4">Available Tasks</h3>
    <div class="row g-4">

        @forelse($tasks as $task)
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $task->title }}</h5>
                    <p class="card-text">{{ $task->description }}</p>

                    <!-- Inside your task card -->
                    <div class="mt-auto d-flex flex-column gap-2">
                        <button class="btn btn-primary w-100 take-task-btn" data-task-id="{{ $task->id }}">
                            Take Task
                        </button>
                        <div class="take-task-container"></div>

                        <a class="btn btn-warning w-100" href="{{ route('taskupdate', $task->id) }}">Update Task</a>

                        <form method="POST" action="{{ route('tasks.destroy', $task->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100" onclick="alert('are you sure')">Delete Task</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        @empty
        <p class="text-muted">No tasks available.</p>
        @endforelse

    </div>
    @else
    <h2 class="mb-3 text-danger">Unauthorized access. Please <a href="{{ route('login2.post') }}">login</a>.</h2>

    @endauth
</div>

<!-- Bootstrap JS -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>



<script>

    $(document).ready(function () {
        $('.take-task-btn').on('click', function () {
            const button = $(this);
            const taskId = button.data('task-id');
            const container = button.siblings('.take-task-container');

            button.hide();

            $.ajax({
                url: `/load-take-task/${taskId}`,
                method: 'GET',
                success: function (response) {
                     container.html(response);

                },
                error: function () {
                    alert('Could not load task actions.');
                }
            });
        });
    });

</script>

</body>
</html>






