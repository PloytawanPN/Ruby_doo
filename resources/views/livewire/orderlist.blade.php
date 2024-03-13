<div style="margin-bottom: 20px">
    <div class="insert_order">
        @if ($product == false)
            <div class="card" wire:click='ch_product(1)'>
                <div class="image">
                    <img src="{{ asset('assets/images/chicken (2).jpg') }}">
                    <label>ไก่ทอด</label>
                </div>
            </div>
            <div class="card">
                <div class="image" wire:click='ch_product(2)'>
                    <img src="{{ asset('assets/images/pop (3).jpg') }}">
                    <label>ไก่ป๊อป</label>
                </div>
            </div>
            <div class="card">
                <div class="image" wire:click='ch_product(3)'>
                    <img src="{{ asset('assets/images/coke.jpg') }}">
                    <label>โค้ก</label>
                </div>
            </div>
            <div class="card">
                <div class="image" wire:click='ch_product(4)'>
                    <img src="{{ asset('assets/images/sw.jpg') }}">
                    <label>ชเวปส์</label>
                </div>
            </div>
        @endif

        @if ($product == true && $size == false)
            @if ($order['product'] == 1 || $order['product'] == 2)
                <div class="card" wire:click='ch_size("S")'>
                    <h1>S</h1>
                </div>
                <div class="card" wire:click='ch_size("M")'>
                    <h1>M</h1>
                </div>
            @endif
            @if ($order['product'] == 1)
                <div class="card" wire:click='ch_size("L")'>
                    <h1>L</h1>
                </div>
                <div class="card" wire:click='ch_size("XL")'>
                    <h1>XL</h1>
                </div>
            @endif
        @endif

        @if ($size == true && $type == false)
            <div class="card" wire:click='ch_type(1)'>
                <div class="image">
                    <img src="{{ asset('assets/images/chicken (2).jpg') }}">
                    <label>ธรรมดา</label>
                </div>
            </div>
            <div class="card" wire:click='ch_type(2)'>
                <div class="image">
                    <img src="{{ asset('assets/images/sauce.jpg') }}">
                    <label>คลุกซอส</label>
                </div>
            </div>
            <div class="card" wire:click='ch_type(3)'>
                <div class="image">
                    <img src="{{ asset('assets/images/powder.jpg') }}">
                    <label>คลุกผง</label>
                </div>
            </div>
        @endif
        @if ($type == true || $order['product'] == 3 || $order['product'] == 4)
            <div class="card">
                <div class="cal_sp">
                    <div class="bt_cal" style="margin-left: 25px" wire:click='minus'><label>-</label></div>
                    <h1>{{ $count }}</h1>
                    <div class="bt_cal" style="margin-right: 25px" wire:click='plus'><label>+</label></div>
                </div>
            </div>
        @endif
    </div>
    <div style="text-align: center">
        <button class="bt_add" wire:click='reset_data'>รีเซ็ต</button>
        @if ($count > 0)
            <button class="bt_add" wire:click='insert_data'>เพิ่ม</button>
        @endif
    </div>
    @if (count($row_order) > 0)
        <div class="summary_order">
            <table>
                @foreach ($row_order as $index => $order)
                    <tr>
                        <td style="width: 20px;cursor: pointer;" wire:click="deleteRow({{ $index }})"><i
                                class='bx bx-x'></i></td>
                        <td>
                            @if ($order['product'] == 1)
                                @switch($order['type'])
                                    @case(1)
                                        ไก่ทอดธรรมดา ({{ $order['size'] }})
                                    @break

                                    @case(2)
                                        ไก่ทอดคลุกซอส ({{ $order['size'] }})
                                    @break

                                    @case(3)
                                        ไก่ทอดคลุกผง ({{ $order['size'] }})
                                    @break

                                    @default
                                @endswitch
                            @elseif ($order['product'] == 2)
                                @switch($order['type'])
                                    @case(1)
                                        ไก่ป๊อปธรรมดา ({{ $order['size'] }})
                                    @break

                                    @case(2)
                                        ไก่ป๊อปคลุกซอส ({{ $order['size'] }})
                                    @break

                                    @case(3)
                                        ไก่ป๊อปคลุกผง ({{ $order['size'] }})
                                    @break

                                    @default
                                @endswitch
                            @elseif ($order['product'] == 3)
                                โค้ก
                            @else
                                ชเวปส์
                            @endif
                        </td>
                        <td>{{ $order['count'] }}</td>
                    </tr>
                @endforeach
            </table>
            <select class="option_money" wire:model='channel'>
                <option value="" selected disabled hidden>เลือกช่องทาง</option>
                <option value=1>เงินสด</option>
                <option value=2>QR-Code</option>
                <option value=3>Grab</option>
                <option value=4>Lineman</option>
            </select>
            @error('channel')
                <span style="color: red ; font-size: 13px">โปรดเลือกช่องทางการสั่งซื้อ</span>
            @enderror
        </div>

        <div style="text-align: center">
            <button class="bt_add" wire:click='save_data'>บันทึก</button>
            <button class="bt_add" wire:click='cancel'>ยกเลิก</button>
        </div>
    @endif
    <div class="content_detail">
        @foreach ($group as $set)
            <div class="card">
                @if ($set->channel == 'เงินสด')
                    <div class="image">
                        <img src="{{ asset('assets/images/cash.png') }}">
                    </div>
                @elseif ($set->channel == 'QR-Code')
                    <div class="image">
                        <img src="{{ asset('assets/images/qrcode.png') }}">
                    </div>
                @elseif ($set->channel == 'Grab')
                    <div class="image">
                        <img src="{{ asset('assets/images/grab.png') }}">
                    </div>
                @else
                    <div class="image">
                        <img src="{{ asset('assets/images/lineman.png') }}">
                    </div>
                @endif
                <table>
                    @foreach ($order_list as $list)
                        @if ($list->group_ == $set->group_)
                            <tr>
                                <td class="product">{{ $list->product }}{{ $list->type }}
                                    @if ($list->size != '')
                                        ({{ $list->size }})
                                    @endif
                                </td>
                                <td class="amount">{{ $list->count }}</td>
                                <td class="time">{{ date('H:i', strtotime($list->create_at)) }}</td>
                            </tr>
                        @endif
                    @endforeach
                </table>
            </div>
        @endforeach
    </div>

</div>
