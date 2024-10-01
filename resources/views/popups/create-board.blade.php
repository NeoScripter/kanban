<div class="overlay" id="createBoardPopup">
    <form action="{{ route('dashboard.store') }}" method="post" class="webform" id="addBoardForm">
        @csrf

        <h2 class="webform__title">Add New Board</h2>
        <div class="webform__input-group">
            <label for="boardName">Board Name:</label>
            <input type="text" name="boardName" id="boardName" placeholder="e.g. Web Design" required minlength="2">
        </div>

        <div class="webform__input-group webform__input-group--addBoard">
            <label for="categories">Board Columns:</label>
            <div class="webform__cat-wrapper">
                <input type="text" name="categories[]" class="category-input" placeholder="e.g. ToDo" required
                    minlength="2">
                <button class="webform__delete-cat" type="button">
                    <img src="{{ asset('images/delete-col.svg') }}" alt="">
                </button>
            </div>
            <div class="webform__cat-wrapper">
                <input type="text" name="categories[]" class="category-input" placeholder="e.g. ToDo" required
                    minlength="2">
                <button class="webform__delete-cat" type="button">
                    <img src="{{ asset('images/delete-col.svg') }}" alt="">
                </button>
            </div>
        </div>

        <button class="webform__login-btn" type="button" id="addNewColBtn">+Add New Column</button>

        <button type="submit" class="webform__submit-btn">Create New Board</button>
    </form>
</div>
