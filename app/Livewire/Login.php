<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;

    public function login()
    {

        $credentials = $this->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:3',
        ]);

        if (!Auth::attempt($credentials)) {
            $this->addError('email', 'The provided credentials are incorrect.');
            return;
        }

        $this->reset();

        return redirect()->route('home')->with('success', __('content.flash_login'));
    }

    public function render()
    {
        return view('livewire.login');
    }
}
