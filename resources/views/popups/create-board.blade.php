<div class="overlay" id="createBoardPopup">
    <form action="{{ route('dashboard.store') }}" method="post" class="webform" id="addBoardForm">
        @csrf

        <h2 class="webform__title">{{ __('content.board_add_new_board')}}</h2>
        <div class="webform__input-group">
            <label for="boardName">{{ __('content.board_name')}}</label>
            <input type="text" name="boardName" id="boardName" placeholder="e.g. Web Design" required minlength="2">
        </div>

        <div class="webform__input-group webform__input-group--addBoard">
            <label for="categories">{{ __('content.board_columns')}}</label>
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

        <button class="webform__login-btn" type="button" id="addNewColBtn">+{{ __('content.board_add_new_column')}}</button>

        <button type="submit" class="webform__submit-btn">{{ __('content.board_create_new_board')}}</button>
    </form>
</div>
