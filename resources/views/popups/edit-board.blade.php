<div class="overlay" id="editBoardPopup">
    <form action="{{ route('dashboard.edit') }}" method="post" class="webform" id="editBoardForm">
        @csrf
        @method('put')

        <h2 class="webform__title">{{ __('content.board_edit_board')}}</h2>
        <div class="webform__input-group">
            <label for="editboardName">{{ __('content.board_name')}}</label>
            <input type="text" name="boardName" id="editboardName" placeholder="e.g. Web Design" required
                minlength="2"
                value="{{ $dashboards ? optional($dashboards->firstWhere('id', session('current_dashboard_id')))->name : '' }}">
        </div>

        <div class="webform__input-group webform__input-group--editBoard">
            <label for="categories">{{ __('content.board_columns')}}</label>
            @if ($dashboards)
                @foreach (optional($dashboards->firstWhere('id', $currentDashboardId))->categories ?? [] as $category)
                    <div class="webform__cat-wrapper">
                        <input type="text" name="categories[]" class="category-input" placeholder="e.g. ToDo"
                            required minlength="2" value="{{ $category->name }}">
                        <button class="webform__delete-cat" type="button">
                            <img src="{{ asset('images/delete-col.svg') }}" alt="">
                        </button>
                    </div>
                @endforeach
            @endif
        </div>

        <button class="webform__login-btn" type="button" id="addNewColBtn">+{{ __('content.board_add_new_column')}}</button>

        <button type="submit" class="webform__submit-btn">{{ __('content.board_save_changes')}}</button>
    </form>
</div>
