<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class Dashboard extends Component
{
    public $cash_count, $scan_count, $line_count, $grab_count;
    public $cash_order, $scan_order, $line_order, $grab_order, $all_order;
    public $cash_price = 0, $scan_price = 0, $line_price = 0, $grab_price = 0;
    public $pop, $chicken, $pop_count = 0, $chicken_count = 0, $date;

    public $days = [];

    public $chartData = [],$sumary;
    public $total_price;

    public function updatedDate()
    {
        $this->cash_price = 0;
        $this->scan_price = 0;
        $this->line_price = 0;
        $this->grab_price = 0;
        $this->pop_count = 0;
        $this->chicken_count = 0;
    }

    public function mount()
    {
        $price_expenses = DB::table('expenses')
            ->select(DB::raw('YEAR(buy_date) as year, MONTH(buy_date) as month, SUM(total_price) as total'))
            ->groupBy(DB::raw('YEAR(buy_date), MONTH(buy_date)'))
            ->get();
        $price_revenue = DB::table('revenue')
            ->select(DB::raw('YEAR(save_date) as year, MONTH(save_date) as month, SUM(total_price) as total'))
            ->groupBy(DB::raw('YEAR(save_date), MONTH(save_date)'))
            ->get();

        $total_expenses = DB::table('expenses')->sum('total_price');
        $total_revenue = DB::table('revenue')->sum('total_price');
        $sumary = abs($total_expenses-$total_revenue);
        $sumary = intval($sumary);
        $total_revenue = intval($total_revenue);
        $total_expenses = intval($total_expenses);

        $this->sumary = [$total_revenue,$total_expenses,$sumary];

        $currentDate = Carbon::now()->startOfMonth()->subMonths(11);

        $data_expenses = [];
        $data_revenue = [];
        $data_profit = [];
        $data_loss = [];

        for ($i = 0; $i < 12; $i++) {
            $date = $currentDate->copy()->addMonths($i);
            $formattedDate = $date->format('F Y');
            $total = 0;
            foreach ($price_revenue as $item) {
                if ($item->year == $date->year && $item->month == $date->month) {
                    $total = intval($item->total);
                    break;
                }
            }
            $data_revenue[] = ['x' => $formattedDate, 'y' => $total];
        }


        for ($i = 0; $i < 12; $i++) {
            $date = $currentDate->copy()->addMonths($i);
            $formattedDate = $date->format('F Y');
            $total = 0;
            foreach ($price_expenses as $item) {
                if ($item->year == $date->year && $item->month == $date->month) {
                    $total = intval($item->total);
                    break;
                }
            }
            $data_expenses[] = ['x' => $formattedDate, 'y' => $total];
        }

        for ($i = 0; $i < 12; $i++) {
            $date = $currentDate->copy()->addMonths($i);
            $formattedDate = $date->format('F Y');

            $profit = $data_revenue[$i]['y'] - $data_expenses[$i]['y'] <= 0 ? 0 : $data_revenue[$i]['y'] - $data_expenses[$i]['y'];

            $data_profit[] = ['x' => $formattedDate, 'y' => $profit];
        }

        for ($i = 0; $i < 12; $i++) {
            $date = $currentDate->copy()->addMonths($i);
            $formattedDate = $date->format('F Y');

            $loss = $data_expenses[$i]['y'] - $data_revenue[$i]['y'] <= 0 ? 0 : $data_expenses[$i]['y'] - $data_revenue[$i]['y'];

            $data_loss[] = ['x' => $formattedDate, 'y' => $loss];
        }

        $this->chartData = [
            [
                'name' => 'รายจ่าย',
                'data' => $data_expenses
            ],
            [
                'name' => 'รายรับ',
                'data' => $data_revenue
            ],
            [
                'name' => 'กำไร',
                'data' => $data_profit
            ],
            [
                'name' => 'ขาดทุน',
                'data' => $data_loss
            ],
        ];

    }
    public function render()
    {
        $this->pop = DB::table('order_list')->where('product', 'ไก่ทอด')
            ->where(function ($query) {
                if ($this->date != "") {
                    $query->whereDate('create_at', $this->date);
                }
            })
            ->get();
        $this->chicken = DB::table('order_list')->where('product', 'ไก่ป๊อป')
            ->where(function ($query) {
                if ($this->date != "") {
                    $query->whereDate('create_at', $this->date);
                }
            })->get();

        $this->cash_count = DB::table('order_list')->where('channel', 'เงินสด')
            ->where(function ($query) {
                if ($this->date != "") {
                    $query->whereDate('create_at', $this->date);
                }
            })->count();
        $this->scan_count = DB::table('order_list')->where('channel', 'QR-Code')
            ->where(function ($query) {
                if ($this->date != "") {
                    $query->whereDate('create_at', $this->date);
                }
            })->count();
        $this->line_count = DB::table('order_list')->where('channel', 'Lineman')
            ->where(function ($query) {
                if ($this->date != "") {
                    $query->whereDate('create_at', $this->date);
                }
            })->count();
        $this->grab_count = DB::table('order_list')->where('channel', 'Grab')
            ->where(function ($query) {
                if ($this->date != "") {
                    $query->whereDate('create_at', $this->date);
                }
            })->count();

        $this->cash_order = DB::table('order_list')->where('channel', 'เงินสด')
            ->where(function ($query) {
                if ($this->date != "") {
                    $query->whereDate('create_at', $this->date);
                }
            })->get();
        $this->scan_order = DB::table('order_list')->where('channel', 'QR-Code')
            ->where(function ($query) {
                if ($this->date != "") {
                    $query->whereDate('create_at', $this->date);
                }
            })->get();
        $this->line_order = DB::table('order_list')->where('channel', 'Lineman')
            ->where(function ($query) {
                if ($this->date != "") {
                    $query->whereDate('create_at', $this->date);
                }
            })->get();
        $this->grab_order = DB::table('order_list')->where('channel', 'Grab')
            ->where(function ($query) {
                if ($this->date != "") {
                    $query->whereDate('create_at', $this->date);
                }
            })->get();

        $this->all_order = DB::table('order_list')
            ->where(function ($query) {
                if ($this->date != "") {
                    $query->whereDate('create_at', $this->date);
                }
            })->get();

        foreach ($this->chicken as $order) {
            if ($order->size = 'S') {
                $this->chicken_count += 3;
            } elseif ($order->size = 'M') {
                $this->chicken_count += 5;
            } elseif ($order->size = 'L') {
                $this->chicken_count += 7;
            } elseif ($order->size = 'XL') {
                $this->chicken_count += 10;
            }
        }

        foreach ($this->pop as $order) {
            if ($order->size = 'S') {
                $this->pop_count += 100;
            } elseif ($order->size = 'M') {
                $this->pop_count += 200;
            }
        }

        foreach ($this->grab_order as $order) {
            $money = 0;
            if ($order->product == 'ไก่ทอด') {
                if ($order->type == 'ธรรมดา') {
                    if ($order->size == 'S') {
                        $money = 59;
                    } elseif ($order->size == 'M') {
                        $money = 85;
                    } elseif ($order->size == 'L') {
                        $money = 111;
                    } elseif ($order->size == 'XL') {
                        $money = 149;
                    }
                } elseif ($order->type == 'คลุกผง') {
                    if ($order->size == 'S') {
                        $money = 59;
                    } elseif ($order->size == 'M') {
                        $money = 85;
                    } elseif ($order->size == 'L') {
                        $money = 111;
                    } elseif ($order->size == 'XL') {
                        $money = 149;
                    }
                } elseif ($order->type == 'คลุกซอส') {
                    if ($order->size == 'S') {
                        $money = 69;
                    } elseif ($order->size == 'M') {
                        $money = 95;
                    } elseif ($order->size == 'L') {
                        $money = 121;
                    } elseif ($order->size == 'XL') {
                        $money = 159;
                    }
                }
            } elseif ($order->product == 'ไก่ป๊อป') {
                if ($order->type == 'ธรรมดา') {
                    if ($order->size == 'S') {
                        $money = 49;
                    } elseif ($order->size == 'M') {
                        $money = 79;
                    }
                } elseif ($order->type == 'คลุกผง') {
                    if ($order->size == 'S') {
                        $money = 49;
                    } elseif ($order->size == 'M') {
                        $money = 79;
                    }
                } elseif ($order->type == 'คลุกซอส') {
                    if ($order->size == 'S') {
                        $money = 59;
                    } elseif ($order->size == 'M') {
                        $money = 89;
                    }
                }
            } elseif ($order->product == 'ชเวปส์') {
                $money = 30;
            } elseif ($order->product == 'โค้ก') {
                $money = 25;
            }
            $this->grab_price += ($money * $order->count);
        }
        $this->grab_price = $this->grab_price - ($this->grab_price * 0.33);

        foreach ($this->line_order as $order) {
            $money = 0;
            if ($order->product == 'ไก่ทอด') {
                if ($order->type == 'ธรรมดา') {
                    if ($order->size == 'S') {
                        $money = 59;
                    } elseif ($order->size == 'M') {
                        $money = 85;
                    } elseif ($order->size == 'L') {
                        $money = 111;
                    } elseif ($order->size == 'XL') {
                        $money = 149;
                    }
                } elseif ($order->type == 'คลุกผง') {
                    if ($order->size == 'S') {
                        $money = 59;
                    } elseif ($order->size == 'M') {
                        $money = 85;
                    } elseif ($order->size == 'L') {
                        $money = 111;
                    } elseif ($order->size == 'XL') {
                        $money = 149;
                    }
                } elseif ($order->type == 'คลุกซอส') {
                    if ($order->size == 'S') {
                        $money = 69;
                    } elseif ($order->size == 'M') {
                        $money = 95;
                    } elseif ($order->size == 'L') {
                        $money = 121;
                    } elseif ($order->size == 'XL') {
                        $money = 159;
                    }
                }
            } elseif ($order->product == 'ไก่ป๊อป') {
                if ($order->type == 'ธรรมดา') {
                    if ($order->size == 'S') {
                        $money = 49;
                    } elseif ($order->size == 'M') {
                        $money = 79;
                    }
                } elseif ($order->type == 'คลุกผง') {
                    if ($order->size == 'S') {
                        $money = 49;
                    } elseif ($order->size == 'M') {
                        $money = 79;
                    }
                } elseif ($order->type == 'คลุกซอส') {
                    if ($order->size == 'S') {
                        $money = 59;
                    } elseif ($order->size == 'M') {
                        $money = 89;
                    }
                }
            } elseif ($order->product == 'ชเวปส์') {
                $money = 30;
            } elseif ($order->product == 'โค้ก') {
                $money = 25;
            }
            $this->line_price += ($money * $order->count);
        }
        $this->line_price = $this->line_price - ($this->line_price * 0.33);

        foreach ($this->scan_order as $order) {
            $money = 0;
            if ($order->product == 'ไก่ทอด') {
                if ($order->type == 'ธรรมดา') {
                    if ($order->size == 'S') {
                        $money = 30;
                    } elseif ($order->size == 'M') {
                        $money = 50;
                    } elseif ($order->size == 'L') {
                        $money = 70;
                    } elseif ($order->size == 'XL') {
                        $money = 100;
                    }
                } elseif ($order->type == 'คลุกผง') {
                    if ($order->size == 'S') {
                        $money = 30;
                    } elseif ($order->size == 'M') {
                        $money = 50;
                    } elseif ($order->size == 'L') {
                        $money = 70;
                    } elseif ($order->size == 'XL') {
                        $money = 100;
                    }
                } elseif ($order->type == 'คลุกซอส') {
                    if ($order->size == 'S') {
                        $money = 39;
                    } elseif ($order->size == 'M') {
                        $money = 59;
                    } elseif ($order->size == 'L') {
                        $money = 79;
                    } elseif ($order->size == 'XL') {
                        $money = 119;
                    }
                }
            } elseif ($order->product == 'ไก่ป๊อป') {
                if ($order->type == 'ธรรมดา') {
                    if ($order->size == 'S') {
                        $money = 25;
                    } elseif ($order->size == 'M') {
                        $money = 45;
                    }
                } elseif ($order->type == 'คลุกผง') {
                    if ($order->size == 'S') {
                        $money = 25;
                    } elseif ($order->size == 'M') {
                        $money = 45;
                    }
                } elseif ($order->type == 'คลุกซอส') {
                    if ($order->size == 'S') {
                        $money = 30;
                    } elseif ($order->size == 'M') {
                        $money = 50;
                    }
                }
            } elseif ($order->product == 'ชเวปส์') {
                $money = 20;
            } elseif ($order->product == 'โค้ก') {
                $money = 15;
            }
            $this->scan_price += ($money * $order->count);
        }

        foreach ($this->cash_order as $order) {
            $money = 0;
            if ($order->product == 'ไก่ทอด') {
                if ($order->type == 'ธรรมดา') {
                    if ($order->size == 'S') {
                        $money = 30;
                    } elseif ($order->size == 'M') {
                        $money = 50;
                    } elseif ($order->size == 'L') {
                        $money = 70;
                    } elseif ($order->size == 'XL') {
                        $money = 100;
                    }
                } elseif ($order->type == 'คลุกผง') {
                    if ($order->size == 'S') {
                        $money = 30;
                    } elseif ($order->size == 'M') {
                        $money = 50;
                    } elseif ($order->size == 'L') {
                        $money = 70;
                    } elseif ($order->size == 'XL') {
                        $money = 100;
                    }
                } elseif ($order->type == 'คลุกซอส') {
                    if ($order->size == 'S') {
                        $money = 39;
                    } elseif ($order->size == 'M') {
                        $money = 59;
                    } elseif ($order->size == 'L') {
                        $money = 79;
                    } elseif ($order->size == 'XL') {
                        $money = 119;
                    }
                }
            } elseif ($order->product == 'ไก่ป๊อป') {
                if ($order->type == 'ธรรมดา') {
                    if ($order->size == 'S') {
                        $money = 25;
                    } elseif ($order->size == 'M') {
                        $money = 45;
                    }
                } elseif ($order->type == 'คลุกผง') {
                    if ($order->size == 'S') {
                        $money = 25;
                    } elseif ($order->size == 'M') {
                        $money = 45;
                    }
                } elseif ($order->type == 'คลุกซอส') {
                    if ($order->size == 'S') {
                        $money = 30;
                    } elseif ($order->size == 'M') {
                        $money = 50;
                    }
                }
            } elseif ($order->product == 'ชเวปส์') {
                $money = 20;
            } elseif ($order->product == 'โค้ก') {
                $money = 15;
            }
            $this->cash_price += ($money * $order->count);
        }
        $this->total_price = $this->cash_price + $this->scan_price + $this->line_price + $this->grab_price;

        return view('livewire.dashboard');
    }
}
