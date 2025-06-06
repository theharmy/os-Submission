<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $username = '';
    public $password = '';
    public $remember = false;

    protected $rules = [
        'username' => 'required|string',
        'password' => 'required|string',
    ];

    public function login()
    {
        $this->validate();

        // Attempt login using username (name field)
        if (Auth::attempt([
            'name' => $this->username,
            'password' => $this->password
        ], $this->remember)) {
            
            session()->regenerate();
            
            return $this->redirect('/dashboard', navigate: true);
        }

        // Login failed
        $this->addError('username', 'The provided credentials do not match our records.');
    }

    public function render()
    {
        return view('livewire.auth.login')
            ->layout('layouts.app', ['title' => 'Login']);
    }
}
