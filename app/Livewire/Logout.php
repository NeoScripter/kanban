<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Logout extends Component
{
    protected $listeners = ['$refresh'];

    public function logout()
    {
        Auth::logout();

        $this->dispatch('authStatusChanged');
        $this->dispatch('logoutSuccess');

    }

    public function render()
    {
        return view('livewire.logout');
    }
}
