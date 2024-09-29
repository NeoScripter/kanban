<?php

namespace App\Livewire;

use App\Models\Dashboard as DashboardModel;
use Livewire\Component;

class Dashboard extends Component
{
    public $userId;
    public $dashboards;
    public $newDashboard;

    public function mount($userId)
    {
        $this->userId = $userId;
        $this->dashboards = DashboardModel::where('user_id', $userId)->get();
    }

    public function addDashboard()
    {
        DashboardModel::create(['name' => $this->newDashboard, 'user_id' => $this->userId]);
        $this->dashboards = DashboardModel::where('user_id', $this->userId)->get();
        $this->newDashboard = '';
    }

    public function deleteDashboard($dashboardId)
    {
        DashboardModel::destroy($dashboardId);
        $this->dashboards = DashboardModel::where('user_id', $this->userId)->get();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }

}
