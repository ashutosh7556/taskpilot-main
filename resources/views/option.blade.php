
{{-- @extends('welcome') --}}

<!DOCTYPE html>
<html>
<head>
    <title> TaskPilot</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">TaskPilot</a>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.options') }}">home</a>
                </li>

            </ul>
        </div>
    </div>
</nav>

<form>
    <div class="container text-center mt-5" >
        <h2>Welcome, user</h2>
        <p>Please choose an option:</p>

        <a  class="btn btn-primary m-2" href="{{route('login2.post')}}">
            <i class="bi bi-box-arrow-in-right"></i> Login
        </a>

        <a  class="btn btn-success m-2" href="{{route('register.submit')}}" >
            <i class="bi bi-person-plus"  ></i> Register
        </a>
    </div>
</form>

<!-- Bootstrap Icons (optional) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</body>
</html>

