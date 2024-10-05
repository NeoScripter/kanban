<div class="dashboard">

    @auth
        @forelse ($dashboards as $dashboard)
            <div class="dashboard__grid">
                @if (session('current_dashboard_id') == $dashboard->id)
                    @foreach ($dashboard->categories as $category)
                        <div class="dashboard__column">
                            <h3 class="dashboard__title"><span class="dashboard__color"></span> {{ $category->name }} ({{ $category->tasks->count() }})</h3>
                            @foreach ($category->tasks as $task)
                                <a href="{{ route('task.display', $task) }}" class="dashboard__task">
                                    <h4 class="dashboard__task-title">{{ $task->title }}</h4>
                                    <p class="dashboard__task-content">{{ $task->subtasks->where('is_completed', true)->count() }} {{ __('content.dashboard_of')}} {{ $task->subtasks->count() }} {{ __('content.dashboard_subtasks')}}</p>
                                </a>
                            @endforeach
                        </div>
                    @endforeach

                    <button class="dashboard__column--new" id="addNewColumnDashboardBtn">
                        +{{ __('content.dashboard_new_column')}}
                    </button>
                @endif
            </div>
        @empty
            <div class="dashboard__empty">
                <h3 class="dashboard__empty-content">{{ __('content.dashboard_create_new_column')}}</h3>
                <button class="dashboard__empty-btn" id="addNewColumnDashboardBtn">+{{ __('content.dashboard_add_new_column')}}</button>
            </div>
        @endforelse
    @endauth

    @guest
        <div class="dashboard__empty">
            <h3 class="dashboard__empty-content">{{ __('content.dashboard_logged_out')}}</h3>
            <button class="dashboard__empty-btn" id="loginDashboardBtn">{{ __('content.dashboard_login')}}</button>
        </div>
    @endguest

    <button class="sidebar__show-btn">
        <img src="{{ asset('images/show-bar.svg') }}" alt="show bar">
    </button>
</div>
