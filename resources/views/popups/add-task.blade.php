<div class="overlay" id="addTaskPopup">
    <form action="{{ route('dashboard.store') }}" method="post" class="webform" id="addTaskForm">
        @csrf

        <h2 class="webform__title">Add New Task</h2>
        <div class="webform__input-group">
            <label for="taskName">Title:</label>
            <input type="text" name="taskName" id="taskName" placeholder="e.g. Web Design" required minlength="2">
        </div>

        <div class="webform__input-group">
            <label for="taskDescription">Description:</label>
            <textarea type="text" name="taskDescription" rows="4" id="taskDescription" placeholder="e.g. It’s always good to take a break. This 15 minute break will recharge the batteries a little."></textarea>
        </div>

        <div class="webform__input-group webform__input-group--addTask">
            <label for="subtasks">Board Columns:</label>
            <div class="webform__cat-wrapper">
                <input type="text" name="subtasks[]" class="category-input" placeholder="e.g. Make coffee" required
                    minlength="2">
                <button class="webform__delete-cat" type="button">
                    <img src="{{ asset('images/delete-col.svg') }}" alt="">
                </button>
            </div>
            <div class="webform__cat-wrapper">
                <input type="text" name="subtasks[]" class="category-input" placeholder="e.g. Drink coffee and smile"
                    required minlength="2">
                <button class="webform__delete-cat" type="button">
                    <img src="{{ asset('images/delete-col.svg') }}" alt="">
                </button>
            </div>
        </div>

        <button class="webform__login-btn" type="button" id="addNewSubtaskBtn">+Add New Subtask</button>

        <div class="webform__input-group">
            <label for="boardName">Status:</label>
            <select name="selectTaskStatus" id="selectTaskStatus">
                <option value="ToDo">ToDo</option>
                <option value="ToDo">Doing</option>
                <option value="ToDo">Done</option>
            </select>
        </div>

        <button type="submit" class="webform__submit-btn">Create Task</button>
    </form>
</div>
