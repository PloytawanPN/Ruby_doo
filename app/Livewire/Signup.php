<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class Signup extends Component
{
    public $username,$password,$confirm_password;
    public function register(){
        $this->validate([
            'username' => ['required',function ($attribute, $value, $fail) {
                $user=DB::table('users')->where('username',$this->username)->count();
                if ($user != 0) {
                    $fail('This username already exists.');
                }
            },],
            'password' => ['required','min:8','regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/'],
            'confirm_password' => 'required|same:password',
        ]);
        DB::table('users')->insert([
            'username'=>$this->username,
            'password'=> Hash::make($this->password),
            'role'=>0,
            'create_at'=>Carbon::now()
        ]);
        Session::flash('success', 'Your success message here');
        return redirect('/signin');
    }
    public function render()
    {
        return view('livewire.signup');
    }
}
