<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Orderlist extends Component
{
    public $product = false, $size = false, $type = false, $count = 0,$group, $channel = '', $order_list;

    public $order = ['product' => '', 'size' => '', 'type' => '', 'count' => ''];
    public $row_order = [];
    public function deleteRow($index)
    {
        unset($this->row_order[$index]);
        $this->row_order = array_values($this->row_order);
    }
    public function insert_data()
    {
        $this->row_order[] = $this->order;
        $this->order = ['product' => '', 'size' => '', 'type' => '', 'count' => ''];
        $this->product = false;
        $this->size = false;
        $this->type = false;
        $this->count = 0;
    }
    public function minus()
    {
        $this->count -= 1;
        if ($this->count < 0) {
            $this->count = 0;
        }
        $this->order['count'] = $this->count;
    }
    public function plus()
    {
        $this->count += 1;
        $this->order['count'] = $this->count;
    }
    public function reset_data()
    {
        $this->order = ['product' => '', 'size' => '', 'type' => '', 'count' => ''];
        $this->product = false;
        $this->size = false;
        $this->type = false;
        $this->count = 0;
    }

    public function cancel()
    {
        $this->order = ['product' => '', 'size' => '', 'type' => '', 'count' => ''];
        $this->product = false;
        $this->size = false;
        $this->type = false;
        $this->count = 0;
        $this->row_order = [];
        $this->channel = "";
    }

    public function ch_product($id)
    {
        $this->product = true;
        $this->order['product'] = $id;
    }
    public function ch_size($size)
    {
        $this->size = true;
        $this->order['size'] = $size;
    }
    public function ch_type($type)
    {
        $this->type = true;
        $this->order['type'] = $type;
    }
    public function save_data()
    {
        $this->validate(['channel' => 'required']);
        $this->resetValidation();
        $maxGroup = DB::table('order_list')->max('group_');
        foreach ($this->row_order as $row) {
            DB::table('order_list')->insert([
                'product' => $row['product'] == 1 ? 'ไก่ทอด' : ($row['product'] == 2 ? 'ไก่ป๊อป' : ($row['product'] == 3 ? 'โค้ก' : 'ชเวปส์')),
                'size' => $row['size'],
                'type' => $row['type'] === "" ? "" : ($row['type'] == 1 ? 'ธรรมดา' : ($row['type'] == 2 ? 'คลุกซอส' : 'คลุกผง')),
                'count' => $row['count'],
                'group_' => $maxGroup === null ? 0 : ($maxGroup + 1),
                'channel' => $this->channel == 1 ? 'เงินสด' : ($this->channel == 2 ? 'QR-Code' : ($this->channel == 3 ? 'Grab' : 'Lineman')),
                'create_at' => Carbon::now(),
            ]);
        }
        $this->cancel();

    }
    public function render()
    {
        $currentDate = Carbon::today();
        $this->group = DB::table('order_list')
            ->select('group_','channel')
            ->whereDate('create_at', $currentDate)
            ->distinct()
            ->get();
        $this->order_list = DB::table('order_list')
            ->whereDate('create_at', $currentDate)
            ->get();
        return view('livewire.orderlist');
    }
}
