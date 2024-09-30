<sidebar class="sidebar__overlay">

    <div class="sidebar">
        <h3 class="sidebar__title">All Boards (3)</h3>

        <ul class="sidebar__boards">
            <li class="sidebar__board sidebar__board--selected">
                <button>
                    {!! file_get_contents(public_path('images/board.svg')) !!}
                    Platform Launch
                </button>
            </li>
            <li class="sidebar__board">
                <button>
                    {!! file_get_contents(public_path('images/board.svg')) !!}
                    Marketing Plan
                </button>
            </li>
            <li class="sidebar__board">
                <button>
                    {!! file_get_contents(public_path('images/board.svg')) !!}
                    Roadmap
                </button>
            </li>
        </ul>

        <button class="sidebar__create-btn">
            {!! file_get_contents(public_path('images/board.svg')) !!}
            + Create new board
        </button>

        <div class="sidebar__theme-group">
            <div class="sidebar__theme-wrapper">
                <div class="sidebar__theme-icon">
                    <img src="{{ asset('images/day.svg') }}" alt="light theme">
                </div>
                <div class="sidebar__theme-toggle">
                    <input type="checkbox" id="dark-mode" class="sidebar__theme-checkbox">
                    <label for="dark-mode"></label>
                </div>
                <div class="sidebar__theme-icon">
                    <img src="{{ asset('images/night.svg') }}" alt="night theme">
                </div>
            </div>
        </div>


        @guest
            <button class="sidebar__login" id="openLoginPopup">
                {!! file_get_contents(public_path('images/login.svg')) !!}
                Login
            </button>

            <button class="sidebar__signup" id="openSignupPopup">
                {!! file_get_contents(public_path('images/signup.svg')) !!}
                Sign up
            </button>
        @endguest

        @auth
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button class="sidebar__logout" id="logoutBtn" aria-label="Log out">
                    {!! file_get_contents(public_path('images/login.svg')) !!}
                    Logout
                </button>
            </form>
        @endauth


        <button class="sidebar__hide-btn">
            {!! file_get_contents(public_path('images/hide-bar.svg')) !!}
            Hide Bar
        </button>

    </div>

</sidebar>
