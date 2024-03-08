<div>
    @if (session('success'))
        <div class="alert alert-success">
            <div class="icon__wrapper">
                <span class="mdi mdi-alert-outline"><i class='bx bx-check'></i></span>
            </div>
            <p>{{ session('success') }}</p>
            <span class="mdi mdi-open-in-new open"></span>
            <span wire:click="hideAlert" class="mdi mdi-close close"><i class='bx bx-x'></i></span>
        </div>
    @endif

    <div class="board">
        <div class="card_board">
            <h1 class="revenue">Total Money</h1>
            <label>{{ number_format($totalPrice, 0, '.', ',') }} ฿</label>
        </div>
        <div class="card_board">
            <h1 class="revenue">This Month</h1>
            <label>{{ number_format($thismonth, 0, '.', ',') }} ฿</label>
        </div>
        <div class="card_board">
            <h1 class="revenue">Last Month</h1>
            <label>{{ number_format($lastmonth, 0, '.', ',') }} ฿</label>
        </div>
        <div class="card_board">
            <h1 class="revenue">Two Month Ago</h1>
            <label>{{ number_format($twomonth, 0, '.', ',') }} ฿</label>
        </div>
    </div>


    @if (count($rows) != 0)
        <div class="table_card">
            <table>
                <tbody>
                    @foreach ($rows as $index => $row)
                        <tr class="tb_row">
                            <td class="index_num">{{ $index + 1 }}
                                @if ($errors->has("rows.{$index}.channel") || $errors->has("rows.{$index}.price"))
                                    <span class="error">*</span>
                                @endif
                            </td>
                            <td>
                                <input type="text" class="input_field" placeholder="Channel name"
                                    wire:model="rows.{{ $index }}.channel" list="channel_list">
                                <datalist id="channel_list">
                                    @foreach ($channel as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </datalist>
                            </td>
                            <td><input type="text" class="input_field" placeholder="Total price"
                                    wire:model="rows.{{ $index }}.price"></td>
                            <td><input type="date" class="input_field"
                                    wire:model="rows.{{ $index }}.currentDate">
                            </td>
                            <td class="delete_bt" wire:click='deleteRow({{ $index }})'><i class='bx bx-x'></i>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    <div class="addrow_con">
        <button class="addrow_bt" wire:click='addRow'>Add <i class='bx bx-plus'></i></button>
    </div>
    @if (count($rows) != 0)
        <div class="addrow_con">
            <button class="addrow_bt" wire:click='savedata'>Save <i class='bx bx-save'></i></button>
        </div>
    @endif

    <div class="card_datatable">
        <div class="table-responsive" wire:ignore>
            <table id="myTable" style="width: 100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Channel</th>
                        <th>Price</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datalist as $item)
                        <tr wire:key="{{ $item->id }}">
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $item->channel }}</td>
                            <td>{{ $item->total_price }}</td>
                            <td>{{ date('d/m/Y', strtotime($item->save_date)) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
