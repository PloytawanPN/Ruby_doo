<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class ApproveStock extends Component
{
    public $pick_stock, $date;

    public function approve($id){
        $item=DB::table('pick_stock')->where('id',$id)->first();
        $user=DB::table('users')->where('username',Session::get('username'))->first();
        DB::table('pick_stock')->where('id',$id)->update([
            'status'=>1,
            'approve_id'=>$user->id,
        ]);
        $currentAmount = DB::table('stock')->where('id', $item->item_id)->value('amount');
        DB::table('stock')->where('id',$item->item_id)->update([
            'amount'=>$currentAmount - $item->amount<0?0:$currentAmount - $item->amount,
        ]);
    }
    public function mount()
    {
        $this->date = Carbon::now()->toDateString();
    }
    public function render()
    {
        $this->pick_stock = DB::table('pick_stock')
            ->whereDate('create_at', Carbon::parse($this->date))
            ->get();
        return view('livewire.approve-stock');
    }
}
