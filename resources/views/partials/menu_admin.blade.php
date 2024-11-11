<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('admin.index') }}" class="app-brand-link">
            <span class="app-brand-logo demo">

            </span>
            <span class="app-brand-text demo menu-text fw-bold ms-1" style="margin-right: 0; padding-right: 50px;">Admin Panel</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm d-flex align-items-center justify-content-center"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards (متاح للجميع) -->
        <li class="menu-item {{ request()->routeIs('admin.index') ? 'active' : '' }}">
            <a href="{{ route('admin.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-smile"></i>
                <div class="text-truncate">Dashboard</div>
            </a>
        </li>

        <!-- Manage Categories -->
        <li class="menu-item {{ request()->routeIs('categories.index') ? 'active' : '' }}">
            <a href="{{ route('categories.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-category"></i>
                <div class="text-truncate">Manage Categories</div>
            </a>
        </li>

        <!-- Manage Products -->
        <li class="menu-item {{ request()->routeIs('products.index') ? 'active' : '' }}">
            <a href="{{ route('products.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div class="text-truncate">Manage Products</div>
            </a>
        </li>

        <!-- Manage Orders -->
        <li class="menu-item {{ request()->routeIs('orders.index') ? 'active' : '' }}">
            <a href="{{ route('orders.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-list-check"></i>
                <div>Manage Orders</div>
            </a>
        </li>

        <!-- Manage Coupons -->
        <li class="menu-item {{ request()->routeIs('coupons.index') ? 'active' : '' }}">
            <a href="{{ route('coupons.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-gift"></i>
                <div class="text-truncate">Manage Coupons</div>
            </a>
        </li>

        <!-- Manage Status -->
        <li class="menu-item {{ request()->routeIs('status.index') ? 'active' : '' }}">
            <a href="{{ route('status.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-tachometer"></i>
                <div class="text-truncate">Manage Status</div>
            </a>
        </li>

        <!-- Manage Blog -->
        <li class="menu-item {{ request()->routeIs('blog.index') ? 'active' : '' }}">
            <a href="{{ route('admin.blog.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-news"></i>
                <div class="text-truncate">Manage Blog</div>
            </a>
        </li>



        <!-- Manage Comments -->

         <!-- Chat -->
         <li class="menu-item {{ request()->routeIs('admin.chat') ? 'active' : '' }}">
            <a href="{{ route('admin.chat', ['receiverId' => 1]) }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-chat"></i>
                <div class="text-truncate">Chat</div>
                @if($newMessagesCount > 0)
                    <span class="badge bg-danger">{{ $newMessagesCount }}</span>
                @endif
            </a>
        </li>


    </ul>
</aside>
