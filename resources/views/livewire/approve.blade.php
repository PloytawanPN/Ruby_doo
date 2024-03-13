<div>
    <div class="row">
        <h1 class="header">Account Request</h1>
        <input placeholder="search..." type="text" wire:model.live='search'>
    </div>

    @foreach ($users as $user)
        <div class="approve_card">
            <div class="flex">
                @if ($user->role == 0)
                    <div class="circle" style="background-color: #ffd900;"></div>
                    <label class="description">{{ $user->username }} : Request to approve account.</label>
                @elseif ($user->role == 1)
                    <div class="circle" style="background-color: #23ff48;"></div>
                    <label class="description">{{ $user->username }} : This account has been approved.</label>
                @else
                    <div class="circle" style="background-color: #36e6d7;"></div>
                    <label class="description">{{ $user->username }} : This account has been approved.</label>
                @endif

            </div>
            <button class="approve" wire:click='approve({{ $user->id }})'>Staff</button>
            <button class="reject" wire:click='owner({{ $user->id }})'>Owner</button>
        </div>
    @endforeach
    @if (count($users) == 0)
        <div class="not_found">
            <h2>Not Found Data !!</h2>
        </div>
    @endif
</div>
