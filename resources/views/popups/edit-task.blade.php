<div class="overlay" id="editTaskOverlay">
    <form action="{{ route('task.edit', $selectedTask->id) }}" method="post" class="webform" id="editTaskForm">
        @csrf
        @method('put')

        <h2 class="webform__title">{{ __('content.task_edit_task')}}</h2>
        <div class="webform__input-group">
            <label for="editTaskName">{{ __('content.task_title')}}</label>
            <input type="text" name="title" id="editTaskName" value="{{ $selectedTask->title }}" required
                minlength="2">
        </div>

        <div class="webform__input-group">
            <label for="EditTaskDescription">{{ __('content.task_description')}}</label>
            <textarea type="text" name="description" rows="4" id="EditTaskDescription">{{ $selectedTask->description }}</textarea>
        </div>

        <div class="webform__input-group webform__input-group--editTask">
            <label for="subtasks">{{ __('content.task_subtasks')}}</label>

            @foreach ($selectedTask->subtasks as $subtask)
            <div class="webform__cat-wrapper">
                <input type="text" name="subtasks[]" class="category-input" placeholder="e.g. Make coffee" required
                    minlength="2" value="{{ $subtask->title }}">
                <button class="webform__delete-cat" type="button">
                    <img src="{{ asset('images/delete-col.svg') }}" alt="">
                </button>
                </div>
            @endforeach
        </div>

        <button class="webform__login-btn" type="button" id="addNewSubtaskBtnEdit">+{{ __('content.task_add_new_subtask')}}</button>

        <div class="webform__input-group">

            @auth
                @foreach ($dashboards as $dashboard)
                    @if (session('current_dashboard_id') == $dashboard->id)
                        <label for="editSelectTaskStatus">{{ __('content.task_status')}}</label>
                        <select name="editSelectTaskStatus" id="editSelectTaskStatus">
                            @foreach ($dashboard->categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    @endif
                @endforeach
            @endauth
        </div>

        <button type="submit" class="webform__submit-btn">{{ __('content.task_update_task')}}</button>
    </form>
</div>
