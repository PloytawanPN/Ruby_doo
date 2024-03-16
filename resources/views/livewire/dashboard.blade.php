<div>
    <div class="first_header">
        <label class="summary_header">Summary sales</label>
        <div class="search">
            <label>Search : </label>
            <input type="date" wire:model.live='date'>
        </div>
    </div>

    <div class="board">
        <div class="card_board">
            <img src="{{ asset('assets/images/cash.png') }}">
            <h3>CASH : {{ number_format($cash_count) }}</h3>
            <hr class="main_line">
            <div class="over_flow">
                <table>
                    @foreach ($cash_order as $order)
                        <tr>
                            <td>
                                @if ($order->size != null)
                                    {{ $order->product . $order->type }} ({{ $order->size }})
                                @else
                                    {{ $order->product . $order->type }}
                                @endif
                            </td>
                            <td>{{ $order->count }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            @if (count($cash_order) == 0)
                <h2 style="color: rgb(224, 224, 224);margin:20px 0 20px 0">Not Found</h2>
            @endif
            <hr class="under_line">
            <table>
                <tr>
                    <td>
                        <h3>Total Price</h3>
                    </td>
                    <td>
                        <h3>{{ number_format($this->cash_price) }} ฿</h3>
                    </td>
                </tr>
            </table>
        </div>
        <div class="card_board">
            <img src="{{ asset('assets/images/qrcode.png') }}">
            <h3>SCAN : {{ number_format($scan_count) }}</h3>
            <hr class="main_line">
            <div class="over_flow">
                <table>
                    @foreach ($scan_order as $order)
                        <tr>
                            <td>
                                @if ($order->size != null)
                                    {{ $order->product . $order->type }} ({{ $order->size }})
                                @else
                                    {{ $order->product . $order->type }}
                                @endif
                            </td>
                            <td>{{ $order->count }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            @if (count($scan_order) == 0)
                <h2 style="color: rgb(224, 224, 224);margin:20px 0 20px 0">Not Found</h2>
            @endif
            <hr class="under_line">
            <table>
                <tr>
                    <td>
                        <h3>Total Price</h3>
                    </td>
                    <td>
                        <h3>{{ number_format($this->scan_price) }} ฿</h3>
                    </td>
                </tr>
            </table>
        </div>
        <div class="card_board">
            <img src="{{ asset('assets/images/lineman.png') }}">
            <h3>LINEMAN : {{ number_format($line_count) }}</h3>
            <hr class="main_line">
            <div class="over_flow">
                <table>
                    @foreach ($line_order as $order)
                        <tr>
                            <td>
                                @if ($order->size != null)
                                    {{ $order->product . $order->type }} ({{ $order->size }})
                                @else
                                    {{ $order->product . $order->type }}
                                @endif
                            </td>
                            <td>{{ $order->count }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            @if (count($line_order) == 0)
                <h2 style="color: rgb(224, 224, 224);margin:20px 0 20px 0">Not Found</h2>
            @endif
            <hr class="under_line">
            <table>
                <tr>
                    <td>
                        <h3>Total Price</h3>
                    </td>
                    <td>
                        <h3>{{ $this->line_price }} ฿</h3>
                    </td>
                </tr>
            </table>
        </div>
        <div class="card_board">
            <img src="{{ asset('assets/images/grab.png') }}">
            <h3>GRAB : {{ number_format($grab_count) }}</h3>
            <hr class="main_line">
            <div class="over_flow">
                <table>
                    @foreach ($grab_order as $order)
                        <tr>
                            <td>
                                @if ($order->size != null)
                                    {{ $order->product . $order->type }} ({{ $order->size }})
                                @else
                                    {{ $order->product . $order->type }}
                                @endif
                            </td>
                            <td>{{ $order->count }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            @if (count($grab_order) == 0)
                <h2 style="color: rgb(224, 224, 224);margin:20px 0 20px 0">Not Found</h2>
            @endif
            <hr class="under_line">
            <table>
                <tr>
                    <td>
                        <h3>Total Price</h3>
                    </td>
                    <td>
                        <h3>{{ $this->grab_price }} ฿</h3>
                    </td>
                </tr>
            </table>
        </div>
        <div class="card_board">
            <img src="{{ asset('assets/images/chicken.png') }}">
            <h3>น่องไก่ : {{ $chicken_count }} Piece</h3>
            <hr class="main_line">
            <div class="over_flow">
                <table>
                    @foreach ($chicken as $order)
                        <tr>
                            <td>
                                {{ $order->product . $order->type }} ({{ $order->size }})
                            </td>
                            <td>{{ $order->count }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            @if (count($chicken) == 0)
                <h2 style="color: rgb(224, 224, 224);margin:20px 0 20px 0">Not Found</h2>
            @endif
            <hr class="under_line">
        </div>
        <div class="card_board">
            <img src="{{ asset('assets/images/pop.png') }}">
            <h3>ไก่ป๊อป : {{ $pop_count }} g</h3>
            <hr class="main_line">
            <div class="over_flow">
                <table>
                    @foreach ($pop as $order)
                        <tr>
                            <td>
                                {{ $order->product . $order->type }} ({{ $order->size }})
                            </td>
                            <td>{{ $order->count }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            @if (count($pop) == 0)
                <h2 style="color: rgb(224, 224, 224);margin:20px 0 20px 0">Not Found</h2>
            @endif
            <hr class="under_line">
        </div>
        <div class="total_card">
            <h2>Summary</h2>
            <hr class="main_line">
            <div class="over_flow">
                <table>
                    @foreach ($all_order as $order)
                        <tr>
                            <td>
                                @if ($order->size != null)
                                    {{ $order->product . $order->type }} ({{ $order->size }})
                                @else
                                    {{ $order->product . $order->type }}
                                @endif
                            </td>
                            <td>{{ $order->channel }}</td>
                            <td>{{ $order->count }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            @if (count($all_order) == 0)
                <h2 style="color: rgb(224, 224, 224);margin:20px 0 20px 0">Not Found</h2>
            @endif
            <hr class="under_line">
            <h2 class="total_price">Total Price : {{ $total_price }} ฿</h2>
        </div>
    </div>

    <div class="first_header">
        <label class="summary_header">Summary Chart</label>
    </div>
    <div class="board">
        <div class="total_card">
            <div id='circle_chart'></div>
        </div>
        <div class="total_card">
            <div id='chart'></div>
        </div>
    </div>

</div>

@push('js')
    <script>
        var options = {
            dataLabels: {
                enabled: true,
                formatter: function(val) {
                    return val + " ฿";
                },
                dropShadow: {
                    // drop shadow properties...
                }
            },
            chart: {
                type: 'donut',
                height: 480
            },
            dataLabels: {
                enabled: false
            },
            series: @json($sumary),
            labels: ['รายรับ', 'รายจ่าย', 'ส่วนต่าง'],
            colors: ['#2AF282', '#F74969', '#FBC83F']
        };

        var circle_chart = new ApexCharts(document.querySelector("#circle_chart"), options);
        circle_chart.render();
    </script>
    <script>
        var options = {
            chart: {
                type: 'bar',
            },
            series: @json($chartData),

            dataLabels: {
                enabled: false
            },
        };


        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();
    </script>
@endpush
