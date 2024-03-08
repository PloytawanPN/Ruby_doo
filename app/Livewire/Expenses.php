<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Expenses extends Component
{
    public $rows = [], $currentDate, $product, $datalist, $totalPrice, $thismonth, $lastmonth, $twomonth;


    public function deleteRow($index)
    {
        unset($this->rows[$index]);
        $this->rows = array_values($this->rows); // Reset array keys after deletion
    }
    public function addRow()
    {
        $this->rows[] = ['order' => '', 'amount' => '', 'price' => '', 'currentDate' => now()->format('Y-m-d')];
    }

    public function hideAlert()
    {
        session()->forget('success');
    }

    public function savedata()
    {
        foreach ($this->rows as $index => $row) {
            if (
                empty($this->rows[$index]['order']) &&
                empty($this->rows[$index]['amount']) &&
                empty($this->rows[$index]['price'])
            ) {
                unset($this->rows[$index]);
            }
        }

        $this->validate([
            'rows.*.order' => 'required',
            'rows.*.amount' => 'required|numeric',
            'rows.*.price' => 'required|numeric',
        ]);
        foreach ($this->rows as $index => $row) {
            DB::table('expenses')->insert([
                'product' => $row['order'],
                'amount' => $row['amount'],
                'price_unit' => ($row['price'] / $row['amount']),
                'total_price' => $row['price'],
                'buy_date' => $row['currentDate'],
                'create_at' => Carbon::now(),
            ]);
        }

        return redirect('/expenses')->with('success', 'Data saved successfully!');
    }
    public function render()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $lastMonth = ($currentMonth - 1) <= 0 ? 12 : $currentMonth - 1;
        $lastYear = $lastMonth == 12 ? $currentYear - 1 : $currentYear;
        $twoMonthsAgo = Carbon::now()->subMonths(2);
        $twoMonthsAgoMonth = $twoMonthsAgo->month;
        $twoMonthsAgoYear = $twoMonthsAgo->year; 

        $this->product = DB::table('expenses')->distinct()->pluck('product');
        $this->datalist = DB::table('expenses')->orderBy('buy_date', 'desc')->get();
        $this->totalPrice = DB::table('expenses')->sum('total_price');
        $this->thismonth = DB::table('expenses')
            ->whereMonth('buy_date', $currentMonth)
            ->whereYear('buy_date', $currentYear)
            ->sum('total_price');
        $this->lastmonth = DB::table('expenses')
            ->whereMonth('buy_date', $lastMonth)
            ->whereYear('buy_date', $lastYear)
            ->sum('total_price');
        $this->twomonth= DB::table('expenses')
        ->whereMonth('buy_date', $twoMonthsAgoMonth)
        ->whereYear('buy_date', $twoMonthsAgoYear)
        ->sum('total_price');
        return view('livewire.expenses');
    }
}
