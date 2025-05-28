 <!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Task Form</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
 </head>
 <body>
 <div class="container mt-5">

   {{-- Create or Update --}}
   <h2>{{ isset($task) ? 'Update Task' : 'Create Task' }}</h2>

   <form method="POST" action="{{ isset($task) ? url('/taskupdate/'.$task->id.'/edit') : route('tasks.store') }}">
     @csrf


     @if(isset($task))
       @method('PUT')
     @endif

     <div class="mb-3">
       <label for="title" class="form-label">Task Title</label>
       <input id="title" type="text" class="form-control" name="title" value="{{ $task->title ?? '' }}" required>
       @error('title')
         <p class="text-danger">{{ $message }}</p>
       @enderror
     </div>

     <div class="mb-3">
       <label for="description" class="form-label">Description (optional)</label>
       <textarea id="description" class="form-control" name="description">{{ $task->description ?? '' }}</textarea>
       @error('description')
         <p class="text-danger">{{ $message }}</p>
       @enderror
     </div>

     <button class="btn btn-primary" type="submit">
       {{ isset($task) ? 'Update Task' : 'Save Task' }}
     </button>
     <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
   </form>
 </div>

 {{-- Optional: Bootstrap modal for update (example use, not active unless wired in JS) --}}
 @if(isset($task))
 <div class="modal fade" id="updateTaskModal" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
     <div class="modal-content">


        <form method="POST" action="{{ url('/taskupdate/'.$task->id.'/edit') }}">
         @csrf
         @method('PUT')

         <div class="modal-header">
           <h5 class="modal-title">Update Task</h5>

         </div>

         <div class="modal-body">
           <div class="mb-3">
             <label>Title</label>
             <input type="text" name="title" value="{{ $task->title }}" class="form-control">
           </div>
           <div class="mb-3">
             <label>Description</label>
             <textarea name="description" class="form-control">{{ $task->description }}</textarea>
           </div>
         </div>
       </form>
     </div>
   </div>
 </div>
 @endif


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>
 </body>
 </html>
