<div class="overlay" id="deleteTaskPopup">
    <form action="{{ route('task.destroy', $selectedTask) }}" method="post" class="webform">
        @csrf
        @method('delete')

        <h3 class="webform__title-danger">{{ __('content.task_conf_delete')}}</h3>

        <p class="webform__content-danger">{{ __('content.task_confirm_delete')}} "{{ $selectedTask->title }}" {{ __('content.task_confirm_delete_subtasks')}}
        </p>

        <div class="webform__danger-group">
            <button type="submit" class="webform__btn-danger webform__btn-danger--delete">{{ __('content.board_delete')}}</button>
            <button type="button" class="webform__btn-danger webform__btn-danger--cancel" id="cancelDeleteTaskBtn">{{ __('content.board_cancel')}}</button>
        </div>
    </form>
</div>
