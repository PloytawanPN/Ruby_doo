<div style="padding-bottom: 40px">
    <div class="row">
        <h1 class="header">Stock Request</h1>
        <input type="date" wire:model.live='date'>
    </div>

    @foreach ($pick_stock as $item)
        <div class="approve_card">
            <div class="flex">
                @if ($item->status == 0)
                    <div class="circle" style="background-color: #ffd900;"></div>
                @elseif ($item->status == 1)
                    <div class="circle" style="background-color: #23ff48;"></div>
                @endif
                <label class="description">{{ $item->item_name }} ({{ $item->amount }})</label>
            </div>
            @if ($item->status == 0)
                <button class="approve" wire:click='approve({{ $item->id }})'>Approve</button>
            @endif
        </div>
    @endforeach
    @if (count($pick_stock) == 0)
        <div class="not_found">
            <h2>Not Found Data !!</h2>
        </div>
    @endif
</div>
