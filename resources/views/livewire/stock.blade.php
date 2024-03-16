<div>
    <button id="openModalBtn" class="circular-button" wire:click='cancel'><i class='bx bx-plus'></i></button>

    <div id="modal_1" class="modal" wire:ignore.self>
        <div class="modal-content">
            <div class="bg_loader" wire:loading wire:target='setdata'>
                <div class="loader"></div>
            </div>
            <div class="bg_loader" wire:loading wire:target='update_data'>
                <div class="loader_update"></div>
            </div>
            <div class="input_field">
                <div class="header">
                    <label>Product</label>
                </div>
                <input type="text" wire:model="config_product">
            </div>
            <div class="input_field">
                <div class="header">
                    <label>Min amount</label>
                </div>
                <input type="number" wire:model="config_min">
            </div>
            <div class="input_field">
                <div class="header">
                    <label>Edit quantity</label>
                </div>
                <input type="number" wire:model="config_quantity">
            </div>
            <div class="input_field">
                <div class="header">
                    <label>Drawdown</label>
                </div>
                <div class="checkbox-wrapper-51"><input type="checkbox" id="cbx-51"
                        wire:model.live='drawdown' /><label for="cbx-51" class="toggle"><span><svg width="10px"
                                height="10px" viewBox="0 0 10 10">
                                <path
                                    d="M5,1 L5,1 C2.790861,1 1,2.790861 1,5 L1,5 C1,7.209139 2.790861,9 5,9 L5,9 C7.209139,9 9,7.209139 9,5 L9,5 C9,2.790861 7.209139,1 5,1 L5,9 L5,1 Z">
                                </path>
                            </svg></span></label></div>
            </div>
            <div class="bt_modal">
                <button class="save" wire:click='update_data'>Update</button>
                <button class="close_1">Cancel</button>
            </div>
        </div>
    </div>


    <div id="modal" class="modal" wire:ignore.self>
        <div class="modal-content">
            <div class="bg_loader" wire:loading wire:target='save'>
                <div class="loader"></div>
            </div>
            <div class="bg_loader" wire:loading wire:target='cancel'>
                <div class="loader"></div>
            </div>
            <div class="input_field">
                <div class="header">
                    <label>Image</label>
                </div>
                <input type="file" wire:model.live="photo">
                {{-- @error('photo')
                    <span class="error">{{ $message }}</span>
                @enderror --}}
            </div>

            <div class="input_field">
                <div class="header">
                    <label>Product</label>
                </div>
                <input type="text" wire:model="product">
            </div>
            <div class="input_field">
                <div class="header">
                    <label>Min amount</label>
                </div>
                <input type="number" wire:model="min">
            </div>

            <div class="bt_modal">
                <button wire:click='save' class="save">Save</button>
                <button class="close" wire:click='cancel'>Cancel</button>
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
                @if ($item->amount == 0)
                    <div class="st_circle red"></div>
                @elseif ($item->amount <= $item->min)
                    <div class="st_circle orage"></div>
                @elseif ($item->amount > $item->min && $item->amount < $item->min + $item->min * 0.3)
                    <div class="st_circle yellow"></div>
                @else
                    <div class="st_circle"></div>
                @endif

                <div class="card" wire:click='setdata({{ $item->id }})'>
                    <div class="image-container">
                        <img src="{{ route('image.get', ['filename' => $item->img_name]) }}">

                    </div>
                    <table>
                        <tr>
                            <td style="margin-right: 10px">Product</td>
                            <td class="space_dot">:</td>
                            <td class="warp">{{ $item->product }}</td>
                        </tr>
                        <tr>
                            <td>Amount</td>
                            <td class="space_dot">:</td>
                            <td class="warp">
                                {{ number_format($item->amount, 0, '.', ',') }}</td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td class="space_dot">:</td>
                            <td class="warp">{{ number_format($item->total, 0, '.', ',') }}</td>
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
