<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Signin extends Component
{
    public $username, $password;
    public function signin()
    {
        $this->validate([
            'username' => [
                'required',
                function ($attribute, $value, $fail) {
                    $user = DB::table('users')->where('username', $this->username)->count();
                    if ($user == 0) {
                        $fail('This username invalid.');
                    }
                },
            ],
            'password' => [
                'required',
                function ($attribute, $value, $fail) {

                    $user = DB::table('users')->where('username', $this->username)->first();
                    if ($user != null) {
                        if ((Hash::check($this->password, $user->password)) == false) {
                            $fail('This password invalid.');
                        }
                    }else{
                        $fail('please check your username.');
                    }

                }
            ],
        ]);

        Session::put('username', $this->username);
        $user=DB::table('users')->where('username',$this->username)->first();
        Session::put('role', $user->role);

        $this->resetValidation();

        return redirect('/dashboard');

    }
    public function render()
    {
        return view('livewire.signin');
    }
}
