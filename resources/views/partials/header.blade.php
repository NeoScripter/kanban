<header class="header">
    <div class="header__logo-img">
        <img src="{{ asset('images/logo.svg') }}" alt="logo">
    </div>
    <h1 class="header__logo-text">kanban</h1>
    <h2 class="header__board">
        {{ $dashboards ? optional($dashboards->firstWhere('id', session('current_dashboard_id')))->name : '' }}</h2>

    <button class="header__board-btn">
        {{ $dashboards ? optional($dashboards->firstWhere('id', session('current_dashboard_id')))->name : '' }}
        <img src="{{ asset('images/dropdown.svg') }}" alt="purple arrow">
    </button>

    <div class="header__btn-group">

        @auth
            <h3 class="header__board">Hi, {{ auth()->user()->name }}!</h3>

            @foreach ($dashboards as $dashboard)
                @if (session('current_dashboard_id') == $dashboard->id)
                    @if ($dashboard->categories->isNotEmpty())
                        <button class="header__add-btn">
                            <img src="{{ asset('images/plus.svg') }}" alt="plus sign">
                            <span class="header__add-btn-content">Add New Task</span>
                        </button>
                    @else
                        <button class="header__add-btn header__add-btn--disabled">
                            <img src="{{ asset('images/plus.svg') }}" alt="plus sign">
                            <span class="header__add-btn-content">Add New Task</span>
                        </button>
                    @endif
                @endif
            @endforeach

        @endauth

        @guest
            <button class="header__add-btn header__add-btn--disabled">
                <img src="{{ asset('images/plus.svg') }}" alt="plus sign">
                <span class="header__add-btn-content">Add New Task</span>
            </button>
        @endguest


        <button class="header__dots" id="editBoard">
            <img src="{{ asset('images/dots.svg') }}" alt="three vertical dots">
        </button>

    </div>

    @if ($dashboards)
        <div class="header__board-popup">
            <button class="header__edit-board" id="editBoardBtn">Edit Board</button>
            <button class="header__delete-board"  id="deleteBoardPopupBtn">Delete Board</button>
        </div>
    @endif

</header>
