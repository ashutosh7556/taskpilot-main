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
      <a class="navbar-brand" >TaskPilot</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link"  href="{{ route('user.logout') }}" >logout</a>

          </li>
        
        </ul>
      </div>
    </div>
  </nav>
   <div class="container mt-4">
    <h2 class="mb-4">Available Tasks</h2>
     <h2>welcome {{ Auth::user() }} </h2>

    <div class="row g-4">
 
        <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Design Landing Page</h5>
            <p class="card-text">Create a responsive landing page using HTML, CSS, and Bootstrap.</p>
            <button class="btn btn-success w-100">Take Task</button>
          </div>
        </div>
      </div>

       <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Write Blog Post</h5>
            <p class="card-text">Write a 500-word blog post about the benefits of remote work.</p>
            <button class="btn btn-success w-100">Take Task</button>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Data Entry Task</h5>
            <p class="card-text">Enter customer feedback data into the provided Excel sheet.</p>
            <button class="btn btn-success w-100">Take Task</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
