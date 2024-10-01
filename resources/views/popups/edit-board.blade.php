<div class="overlay" id="editBoardPopup">
    <form action="{{ route('dashboard.edit') }}" method="post" class="webform" id="editBoardForm">
        @csrf
        @method('put')

        <h2 class="webform__title">Edit Board</h2>
        <div class="webform__input-group">
            <label for="editboardName">Board Name:</label>
            <input type="text" name="boardName" id="editboardName" placeholder="e.g. Web Design" required
                minlength="2"
                value="{{ $dashboards ? optional($dashboards->firstWhere('id', session('current_dashboard_id')))->name : '' }}">
        </div>

        <div class="webform__input-group webform__input-group--editBoard">
            <label for="categories">Board Columns:</label>
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

        <button class="webform__login-btn" type="button" id="addNewColBtn">+Add New Column</button>

        <button type="submit" class="webform__submit-btn">Save Changes</button>
    </form>
</div>
