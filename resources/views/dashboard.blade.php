    <!DOCTYPE html>
    <html lang="en" xmlns="http://www.w3.org/1999/html">
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

                  <div class="mt-auto d-flex flex-column gap-2">


                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                              <a class="btn btn-primary " href="{{route('taketask')}}"> take task </a>
                          </button>

                        <div class="update">
                      <a class="btn btn-warning w-100"   href="{{ route('taskupdate', $task->id) }}"    >update task</a>
                        </div>

                      @if(session('success'))
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                          {{ session('success') }}
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      @endif

                    <form method="POST" action="{{ route('tasks.destroy', $task->id) }}">
                      @csrf

                      @method('DELETE')
                      <button type="submit" class="btn btn-danger w-100"   onclick="return confirm('Are you sure?')">Delete Task</button>
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
          <h2 class="mb-3 text-danger">Unauthorized access. Please <a href="{{ route('user.login') }}">login</a>.</h2>
        @endauth
      </div>




      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="btn btn-primary " style="width: 75%">Work in progress</button>

                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">

                      <button type="button" class="btn btn-primary " style="width: 75%">Work is done</button>
                  </div>
                  <div class="modal-body">

                      <button type="button" class="btn btn-primary " style="width: 75%">Work is pending</button>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                  </div>
              </div>
          </div>
      </div>
      <!-- Bootstrap JS -->

      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


    </body>
    </html>






