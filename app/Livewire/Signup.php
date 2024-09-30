<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Signup extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    public function signup()
    {
        $this->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:3|confirmed',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        Auth::login($user);

        $this->reset();

        return redirect()->route('home')->with('success', 'Successfully signed up!');
    }

    public function render()
    {
        return view('livewire.signup');
    }
}
