
<!-- Toast Container -->
<div aria-live="polite" aria-atomic="true" style="position: relative;">
    <div id="toastContainer" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999;"></div>
</div>

<div id="status-message" class="mt-3"></div>
    <div class="status-buttons mt-2">
        <div class="d-flex gap-3">
            <form method="POST" action="{{ route('TakeTask') }}" class="flex-grow-1">
                @csrf
                <input type="hidden" name="task_id" value="{{ $task->id }}">
                <button type="submit" name="status" value="in_progress" class="btn btn-warning w-100" onclick="alert('in progress..?')" >

                    In Progress
                </button>
            </form>

            <form method="POST" action="{{ route('TakeTask') }}" class="flex-grow-1">
                @csrf
                <input type="hidden" name="task_id" value="{{ $task->id }}">
                <button type="submit" name="status" value="done" class="btn btn-success w-100" onclick="alert('done..?')">
                    Done
                </button>
            </form>
        </div>
    </div>

