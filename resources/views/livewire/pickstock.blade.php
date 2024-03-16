<div>
    <button id="openModalBtn" class="circular-button" {{-- wire:click='cancel' --}}><i class='bx bx-bolt-circle'></i></button>

    <div id="modal" class="modal" wire:ignore.self>
        <div class="modal-content">
            <div class="input_field">
                <div class="header">
                    <label>ไก่เหลือ</label>
                </div>
                <input type="number" wire:model="leftovers">
            </div>
            @error('leftovers')
                <label class="error">{{ $message }}</label>
            @enderror
            <div class="bt_modal">
                <button class="save" wire:click='save'>Save</button>
                <button class="close" wire:click='cancel'>Cancel</button>
            </div>
        </div>
    </div>

    @if (session('alert'))
        <div class="alert alert-success">
            <div class="icon__wrapper">
                <span class="mdi mdi-alert-outline"><i class='bx bx-check'></i></span>
            </div>
            <p>You have successfully picked up merchandise in stock.</p>
            <span class="mdi mdi-open-in-new open"></span>
            <span class="mdi mdi-close close" onclick="clearAlert()"><i class='bx bx-x'></i></span>
        </div>
    @endif

    <div id="modal_1" class="modal" wire:ignore.self>
        <div class="modal-content">
            <div class="bg_loader" wire:loading wire:target='setdata'>
                <div class="loader_pick"></div>
            </div>
            <div class="input_field">
                <div class="header">
                    <label>Product</label>
                </div>
                <input type="text" wire:model="product" readonly>
            </div>
            <div class="input_field">
                <div class="header">
                    <label>Amount</label>
                </div>
                <input type="number" wire:model="count">
            </div>
            @error('count')
                <label class="error">{{ $message }}</label>
            @enderror
            <div class="bt_modal">
                <button class="save" wire:click='pick_stock'>Withdraw</button>
                <button class="close_1">Cancel</button>
            </div>
        </div>
    </div>


    <div class="card_search">
        <input type="text" placeholder="Serach . . ." wire:model.live='search'>
        <i class='bx bx-search icon'></i>
    </div>
    <div class="content_body">
        @foreach ($product_list as $item)
            <div class="card_body ">
                {{-- @if ($item->amount == 0)
                    <div class="st_circle red"></div>
                @elseif ($item->amount <= $item->min)
                    <div class="st_circle orage"></div>
                @elseif ($item->amount > $item->min && $item->amount < $item->min + $item->min * 0.3)
                    <div class="st_circle yellow"></div>
                @else
                    <div class="st_circle"></div>
                @endif --}}

                <div class="card" wire:click="setdata({{ $item->id }})">
                    <div class="image-container">
                        <img src="{{ route('image.get', ['filename' => $item->img_name]) }}">
                    </div>
                    <table>
                        <tr>
                            <td style="margin-right: 10px">Product</td>
                            <td class="space_dot">:</td>
                            <td class="warp">{{ $item->product }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
    @if (count($product_list) == 0)
        <div class="center-container">
            <h2>Not Found Data</h2>
        </div>
    @endif
</div>
