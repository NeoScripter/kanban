<header class="header">
    <div class="header__logo-img">
        <img src="{{ asset('images/logo.svg') }}" alt="logo">
    </div>
    <h1 class="header__logo-text">kanban</h1>
    <h2 class="header__board">Platform Launch</h2>

    <button class="header__board-btn">
        Platform Launch
        <img src="{{ asset('images/dropdown.svg') }}" alt="purple arrow">
    </button>

    <div class="header__btn-group">

        <button class="header__add-btn">
            <img src="{{ asset('images/plus.svg') }}" alt="plus sign">
            <span class="header__add-btn-content">Add New Task</span>
        </button>

        <button class="header__dots" id="editBoard">
            <img src="{{ asset('images/dots.svg') }}" alt="three vertical dots">
        </button>

    </div>

    <div class="header__board-popup">
        <button class="header__edit-board">Edit Board</button>
        <button class="header__delete-board">Delete Board</button>
    </div>
</header>
