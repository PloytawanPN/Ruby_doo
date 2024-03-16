<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Pickstock extends Component
{
    public $product_list, $search, $product, $count = 1, $id, $leftovers;

    public function setdata($id)
    {
        $this->resetErrorBag('count');
        $this->count = 1;
        $this->id = $id;
        $data = DB::table('stock')->where('id', $id)->first();
        $this->product = $data->product;
    }

    public function cancel()
    {
        $this->leftovers = null;
    }

    public function save()
    {
        $this->validate([
            'leftovers' => [
                'required',
                'numeric',
                'min:0'
            ],
        ]);
        DB::table('leftovers')->insert([
            'amount' => $this->leftovers,
            'create_at' => Carbon::now(),
        ]);
        $amount=DB::table('stock')->where('product','LIKE','%ปีกไก่บน%')->first();
        DB::table('stock')->where('product','LIKE','%ปีกไก่บน%')->update([
            'amount' => ($amount->amount)-$this->leftovers,
        ]);

        return redirect('/pickstock')->with('alert', 'Success!');
    }

    public function pick_stock()
    {
        $this->validate([
            'count' => [
                'required',
                'numeric',
                'min:1',
                function ($attribute, $value, $fail) {
                    $product = DB::table('stock')->where('id', $this->id)->first();
                    if ($product->amount < $value) {
                        $fail('Not enough products.');
                    }
                },
            ],
        ]);

        $user = DB::table('users')->where('username', Session::get('username'))->first();
        DB::table('pick_stock')->insert([
            'item_id' => $this->id,
            'item_name' => $this->product,
            'amount' => $this->count,
            'pick_user_id' => $user->id,
            'status' => 0,
            'create_at' => Carbon::now(),
        ]);

        return redirect('/pickstock')->with('alert', 'Success!');
    }

    public function render()
    {
        $this->product_list = DB::table('stock')
            ->where('status', 1)
            ->where(function ($query) {
                if ($this->search != "") {
                    $query->where('product', 'LIKE', '%' . $this->search . '%');
                }
            })
            ->orderBy('update_at', 'desc')->get();

        return view('livewire.pickstock');
    }
}
