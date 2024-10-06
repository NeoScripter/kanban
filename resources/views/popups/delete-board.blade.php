<div class="overlay" id="deleteBoardPopup">
    <form action="{{ route('dashboard.destroy') }}" method="post" class="webform">
        @csrf
        @method('delete')

        <h3 class="webform__title-danger">{{ __('content.board_conf_delete')}}</h3>

        <p class="webform__content-danger">{{ __('content.board_confirm_delete')}} "{{ $dashboards ? optional($dashboards->firstWhere('id', session('current_dashboard_id')))->name : '' }}" {{ __('content.board_confirm_delete_message')}}</p>

        <div class="webform__danger-group">
            <button type="submit" class="webform__btn-danger webform__btn-danger--delete">{{ __('content.board_delete')}}</button>
            <button type="button" class="webform__btn-danger webform__btn-danger--cancel" id="cancelDeleteBoardBtn">{{ __('content.board_cancel')}}</button>
        </div>
    </form>
</div>
