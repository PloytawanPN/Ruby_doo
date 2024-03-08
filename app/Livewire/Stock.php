<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Stock extends Component
{
    use WithFileUploads;
    public $photo, $product, $min, $product_list, $search;
    public $config_product, $config_min, $config_quantity,$id;

    public function setdata($id)
    {
        $data = DB::table('stock')->where('id', $id)->first();
        $this->config_product = $data->product;
        $this->config_min = $data->min;
        $this->config_quantity = 0;
        $this->id=$id;
    }

    public function update_data()
    {
        $this->validate([
            'config_product' => [
                'required',
                function ($attribute, $value, $fail) {
                    $data = DB::table('stock')->where('product', $value)->count();
                    if ($data > 1) {
                        $fail('This product is already in stock.');
                    }
                }
            ],
            'config_min' => 'required|numeric',
            'config_quantity' => 'required|numeric',
        ]);
        $data= DB::table('stock')->where('id', $this->id)->first();
        DB::table('stock')->where('id', $this->id)->update([
            'product' => $this->config_product,
            'min' => $this->config_min,
            'amount' => ($data->amount + ($this->config_quantity))<0 ? 0 : ($data->amount + ($this->config_quantity)),
            'total' => ($this->config_quantity >= 0) ? ($this->config_quantity+$data->total):($data->total),
            'update_at' => Carbon::now()
        ]);

        return redirect('/stock');
    }
    public function save(Request $request)
    {
        $this->validate([
            'photo' => 'required|image',
            'product' => [
                'required',
                function ($attribute, $value, $fail) {
                    $data = DB::table('stock')->where('product', $value)->count();
                    if ($data != 0) {
                        $fail('This product is already in stock.');
                    }
                }
            ],
            'min' => 'required|numeric',
        ]);

        $filePath = $this->photo->store('photos');
        $fileName = basename($filePath);


        DB::table('stock')->insert([
            'product' => $this->product,
            'min' => $this->min,
            'img_name' => $fileName,
            'amount' => 0,
            'total' => 0,
            'role' => 0,
            'create_at' => Carbon::now()
        ]);

        return redirect('/stock');
    }
    public function cancel()
    {
        $this->photo = null;
        $this->product = null;
        $this->min = null;
    }
    public function render()
    {
        $this->product_list = DB::table('stock')
            ->where(function ($query) {
                if ($this->search != "") {
                    $query->where('product', 'LIKE', '%' . $this->search . '%');
                }
            })
            ->orderBy('update_at','desc')->get();
        return view('livewire.stock');
    }
}
