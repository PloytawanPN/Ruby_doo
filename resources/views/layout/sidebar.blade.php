<div class="sidebar">
    <div class="logo_content">
        <div class="logo">
            <i class='bx bxs-category-alt'></i>
            <div class="logo_name">RubyDoo</div>
        </div>
        <i class="bx bx-menu" id="btn"></i>
    </div>
    <ul>

        @if (Session::has('role') && Session::get('role') == '2')
            <li>
                <a href="/orderlist">
                    <i class='bx bx-check-square'></i>
                    <span class="links_name">ออเดอร์</span>
                </a>
                <span class="tooltip">ออเดอร์</span>
            </li>
            <li>
                <a href="/pickstock">
                    <i class='bx bx-package'></i>
                    <span class="links_name">เบิกของ</span>
                </a>
                <span class="tooltip">เบิกของ</span>
            </li>
        @endif

        @if (Session::has('role') && Session::get('role') == '1')
            <li>
                <a href="/dashboard">
                    <i class="bx bx-grid-alt"></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href="/orderlist">
                    <i class='bx bx-check-square'></i>
                    <span class="links_name">Order List</span>
                </a>
                <span class="tooltip">Order List</span>
            </li>
            <li>
                <a href="/pickstock">
                    <i class='bx bx-transfer-alt'></i>
                    <span class="links_name">Pick Up</span>
                </a>
                <span class="tooltip">Pick Up</span>
            </li>
            <li>
                <a href="/approve_stock">
                    <i class='bx bx-archive'></i>
                    <span class="links_name">Approve</span>
                </a>
                <span class="tooltip">Approve</span>
            </li>
            <li>
                <a href="/stock">
                    <i class='bx bx-package' ></i>
                    <span class="links_name">Stock</span>
                </a>
                <span class="tooltip">Stock</span>
            </li>
            <li>
                <a href="/revenue">
                    <i class='bx bx-wallet-alt'></i>
                    <span class="links_name">Revenue</span>
                </a>
                <span class="tooltip">Revenue</span>
            </li>
            <li>
                <a href="/expenses">
                    <i class='bx bx-credit-card'></i>
                    <span class="links_name">Expenses</span>
                </a>
                <span class="tooltip">Expenses</span>
            </li>
            <li>
                <a href="/approve">
                    <i class='bx bx-check-shield'></i>
                    <span class="links_name">Account</span>
                </a>
                <span class="tooltip">Account</span>
            </li>
        @endif
    </ul>
    <div class="profile_content">
        <div class="profile">
            <livewire:logout />
        </div>
    </div>
</div>
