<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Revenue extends Component
{
    public $rows = [],$channel,$datalist,$totalPrice,$thismonth, $lastmonth, $twomonth;
    public function deleteRow($index)
    {
        unset($this->rows[$index]);
        $this->rows = array_values($this->rows); // Reset array keys after deletion
    }
    public function addRow()
    {
        $this->rows[] = ['channel' => '', 'price' => '', 'currentDate' => now()->format('Y-m-d')];
    }

    public function hideAlert()
    {
        session()->forget('success');
    }

    public function savedata()
    {
        foreach ($this->rows as $index => $row) {
            if (
                empty($this->rows[$index]['channel']) &&
                empty($this->rows[$index]['price'])
            ) {
                unset($this->rows[$index]);
            }
        }

        $this->validate([
            'rows.*.channel' => 'required',
            'rows.*.price' => 'required|numeric',
        ]);
        foreach ($this->rows as $index => $row) {
            DB::table('revenue')->insert([
                'channel' => $row['channel'],
                'total_price' => $row['price'],
                'save_date' => $row['currentDate'],
                'create_at' => Carbon::now(),
            ]);
        }

        return redirect('/revenue')->with('success', 'Data saved successfully!');
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



        $this->channel=DB::table('revenue')->distinct()->pluck('channel');
        $this->datalist = DB::table('revenue')->orderBy('save_date', 'desc')->get();
        $this->totalPrice = DB::table('revenue')->sum('total_price');
        $this->thismonth = DB::table('revenue')
            ->whereMonth('save_date', $currentMonth)
            ->whereYear('save_date', $currentYear)
            ->sum('total_price');
        $this->lastmonth = DB::table('revenue')
            ->whereMonth('save_date', $lastMonth)
            ->whereYear('save_date', $lastYear)
            ->sum('total_price');
        $this->twomonth= DB::table('revenue')
        ->whereMonth('save_date', $twoMonthsAgoMonth)
        ->whereYear('save_date', $twoMonthsAgoYear)
        ->sum('total_price');
        return view('livewire.revenue');
    }
}
