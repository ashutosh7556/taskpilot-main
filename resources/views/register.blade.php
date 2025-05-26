 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1" />
     <title>admin Registration</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
 </head>

 <body>
     <div class="container mt-5">
         <div class="row justify-content-center">
             <div class="col-md-6"> <!-- Adjust width here (e.g., col-md-4 for narrower) -->
                 <h2 class="mb-4 text-center">Register</h2>
                 <form method="post" action="{{ route('register.submit') }}">
                     <div class="mb-3">
                         @csrf

                         <label for="name" class="form-label">Name</label>
                         <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name"
                             required />

                         @error('name')
                             <p style="color: red">{{ $message }}</p>
                         @enderror

                     </div>

                     <div class="mb-3">
                         <label for="email" class="form-label">Email address</label>
                         <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email"
                             required />

                         @error('email')
                             <p style="color: red">{{ $message }}</p>
                         @enderror

                     </div>

                     <div class="mb-3">
                         <label for="password" class="form-label">Password</label>
                         <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" />

                          

                     </div>

                     <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation" id="confirmPassword"
                            placeholder="Confirm password" />
                            
                        @error('password')
                            <p style="color: red">{{ $message }}</p>
                        @enderror
                    </div>


                     <button type="submit" class="btn btn-primary w-30">Register</button>

                     <a href="{{ route('option') }}" class="btn btn-primary w-30">Back</a>

                 </form>
             </div>


         </div>
     </div>
 </body>

 </html>
