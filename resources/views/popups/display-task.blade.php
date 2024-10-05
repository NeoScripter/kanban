@if ($selectedTask)
    @include('popups.delete-task')
    @include('popups.edit-task')
    <div class="overlay overlay--visible">
        <form action="{{ route('task.update', $selectedTask->id) }}" method="post" class="webform" id="displayTaskPopup">
            @csrf
            @method('put')

            <div class="webform__task-headline">
                <h2 class="webform__title">{{ $selectedTask->title }}</h2>
                <button type="button" class="header__dots" id="editTaskShowPopup">
                    <img src="{{ asset('images/dots.svg') }}" alt="three vertical dots">
                </button>
                <div class="header__board-popup" id="editTaskPopup">
                    <button type="button" class="header__edit-board" id="editTaskBtn">Edit Task</button>
                    <button type="button" class="header__delete-board"  id="deleteTaskPopupBtn">Delete Task</button>
                </div>
            </div>
            <div class="webform__input-group">
                <p class="task-description">{{ $selectedTask->description }}</p>
            </div>

            <div class="webform__checkbox-group">
                <h3>Subtasks ({{ $selectedTask->subtasks->where('is_completed', true)->count() }} of
                    {{ $selectedTask->subtasks->count() }})</h3>
                @foreach ($selectedTask->subtasks as $subtask)
                    <label for="subtask-{{ $subtask->id }}"
                        class="webform__checkbox-wrapper{{ $subtask->is_completed ? ' subtask--completed' : '' }}">
                        <input type="checkbox" name="subtasks[{{ $subtask->id }}]" id="subtask-{{ $subtask->id }}"
                            value="{{ $subtask->id }}" class="checkbox-input"
                            {{ $subtask->is_completed ? 'checked' : '' }}>
                        {{ $subtask->title }}
                    </label>
                @endforeach
            </div>


            <div class="webform__input-group">

                @auth
                    @foreach ($dashboards as $dashboard)
                        @if (session('current_dashboard_id') == $dashboard->id)
                            <label for="selectEditingTaskStatus">Current Status:</label>
                            <select name="selectEditingTaskStatus" id="selectEditingTaskStatus">
                                @foreach ($dashboard->categories as $category)
                                    @if ($selectedTask->category_id === $category->id)
                                        <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                                    @else
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        @endif
                    @endforeach
                @endauth
            </div>

            <button type="submit" class="webform__submit-btn">Update Task</button>
        </form>
    </div>
@endif
