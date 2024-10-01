<div class="dashboard">

    @auth
        @forelse ($dashboards as $dashboard)
            <div class="dashboard__grid">
                @if (session('current_dashboard_id') == $dashboard->id)
                    @foreach ($dashboard->categories as $category)
                        <div class="dashboard__column">
                            <h3 class="dashboard__title"><span class="dashboard__color"></span> {{ $category->name }} (4)</h3>
                            <div class="dashboard__task">
                                <h4 class="dashboard__task-title">Build UI for onboarding flow</h4>
                                <p class="dashboard__task-content">0 of 3 subtasks</p>
                            </div>
                            <div class="dashboard__task">
                                <h4 class="dashboard__task-title">Build UI for onboarding flow</h4>
                                <p class="dashboard__task-content">0 of 3 subtasks</p>
                            </div>
                        </div>
                    @endforeach

                    <button class="dashboard__column--new" id="addNewColumnDashboardBtn">
                        +New Column
                    </button>
                @endif
            </div>
        @empty
            <div class="dashboard__empty">
                <h3 class="dashboard__empty-content">This board is empty. Create a new column to get started</h3>
                <button class="dashboard__empty-btn" id="addNewColumnDashboardBtn">+Add New Column</button>
            </div>
        @endforelse
    @endauth

    @guest
        <div class="dashboard__empty">
            <h3 class="dashboard__empty-content">You are currently logged out. Log in to get started</h3>
            <button class="dashboard__empty-btn" id="loginDashboardBtn">Login</button>
        </div>
    @endguest

    <button class="sidebar__show-btn">
        <img src="{{ asset('images/show-bar.svg') }}" alt="show bar">
    </button>
</div>
