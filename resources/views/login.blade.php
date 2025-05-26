<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>user Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <h2 class="mb-4 text-center">Login</h2>
        <form action="{{route('user.dashboard')}}" method="post">

          @csrf

          <div class="mb-3">
            <label for="login" class="form-label">Email</label>
            <input type="text" id="login" name="email" class="form-control" placeholder="Enter your name or email" required />
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" required />
          </div>
          <button type="submit" class="btn btn-primary w-30">Login</button>

          <a href="{{route('option') }}" class="btn btn-primary w-30">Back</a>

        </form>
      </div>
    </div>
  </div>
</body>
</html>
