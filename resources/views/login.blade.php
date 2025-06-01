 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <h2 class="mb-4 text-center">Login</h2>

        <!-- Display validation errors -->
        @if($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
 <form action="{{ route('login2.post') }}" method="post">
  @csrf

  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="text" id="email" name="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}" required />
  </div>

  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" required />
  </div>

  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
    <label class="form-check-label" for="remember">Remember Me</label>
  </div>

  <button type="submit" class="btn btn-primary w-100">Login</button>

  <a href="{{ route('option') }}" class="btn btn-secondary w-100 mt-2">Back</a>
</form>

      </div>
    </div>
  </div>
</body>
</html> 
