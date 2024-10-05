<div class="overlay" id="deleteTaskPopup">
    <form action="{{ route('task.destroy', $selectedTask) }}" method="post" class="webform">
        @csrf
        @method('delete')

        <h3 class="webform__title-danger">Delete this task?</h3>

        <p class="webform__content-danger">Are you sure you want to delete the "{{ $selectedTask->title }}" task and its subtasks? This action cannot be reversed.
        </p>

        <div class="webform__danger-group">
            <button type="submit" class="webform__btn-danger webform__btn-danger--delete">Delete</button>
            <button type="button" class="webform__btn-danger webform__btn-danger--cancel" id="cancelDeleteTaskBtn">Cancel</button>
        </div>
    </form>
</div>
