<div>
    <div class="profile_detail">
        <img src="{{ asset('assets/images/profile.jpg') }}" />
        <div class="name_job">
            <div class="name">{{Session::get('username')}}</div>
            @if (Session::get('role') == '1')
                <div class="job">Owner</div>
            @elseif (Session::get('role') == '2')
                <div class="job">Staff</div>
            @else
                <div class="job">Waiting role</div>
            @endif
        </div>
    </div>
    <i class="bx bx-log-out" id="log_out" wire:click='logout'></i>
</div>
