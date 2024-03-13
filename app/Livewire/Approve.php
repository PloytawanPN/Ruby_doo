<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Approve extends Component
{
    public $users,$search;
    public function approve($id){
        DB::table('users')->where('id',$id)->update([
            'role'=>2
        ]);
    }
    public function owner($id){
        DB::table('users')->where('id',$id)->update([
            'role'=>1
        ]);
    }
    public function render()
    {
        $this->users = DB::table('users')->where(function($query) {
            if($this->search!=""){
                $query->where('username','LIKE','%'.$this->search.'%');
            }
        })->get();
        return view('livewire.approve');
    }
}
