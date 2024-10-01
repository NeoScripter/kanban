<div class="dashboard">

    @auth
        @foreach ($dashboards as $dashboard)
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

                    <button class="dashboard__column--new">
                        +New Column
                    </button>
                @endif
            </div>
        @endforeach
    @endauth

    <button class="sidebar__show-btn">
        <img src="{{ asset('images/show-bar.svg') }}" alt="show bar">
    </button>
</div>
