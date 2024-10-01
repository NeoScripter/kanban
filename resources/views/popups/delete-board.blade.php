<div class="overlay" id="deleteBoardPopup">
    <form action="{{ route('dashboard.destroy', session('current_dashboard_id')) }}" method="post" class="webform">
        @csrf
        @method('delete')

        <h3 class="webform__title-danger">Delete this board?</h3>

        <p class="webform__content-danger">Are you sure you want to delete the "{{ $dashboards ? optional($dashboards->firstWhere('id', session('current_dashboard_id')))->name : '' }}" board? This action will remove all columns and tasks and cannot be reversed.</p>

        <div class="webform__danger-group">
            <button type="submit" class="webform__btn-danger webform__btn-danger--delete">Delete</button>
            <button type="button" class="webform__btn-danger webform__btn-danger--cancel" id="cancelDeleteBoardBtn">Cancel</button>
        </div>
    </form>
</div>
