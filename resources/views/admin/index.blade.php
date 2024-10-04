@extends('layout.admin_master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- قسم التهنئة -->
        <div class="row">
            <div class="col-xxl-12 mb-6 order-0">
                <div class="card">
                    <div class="d-flex align-items-start row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary mb-3">Congratulations {{ $adminName }}! 🎉</h5>
                                <p class="mb-6">
                                    You have done {{ $salesPercentage }}% more sales today.
                                    Check your new badge in your profile.
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-6">
                                <img src="https://i.pinimg.com/564x/c6/3a/89/c63a89ddfeb298f55031cb394b367b57.jpg"
                                height="175" class="scaleX-n1-rtl" alt="New Image" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="mb-4">Admin Dashboard</h3>

        <div class="row">
            <!-- عدد الطلبات -->
            <div class="col-md-4 mb-4">
                <div class="card bg-light text-center">
                    <div class="card-body">
                        <h5 class="card-title">Number of Orders</h5>
                        <p class="card-text">{{ $ordersCount }}</p>
                    </div>
                </div>
            </div>

            <!-- عدد المستخدمين -->
            <div class="col-md-4 mb-4">
                <div class="card bg-light text-center">
                    <div class="card-body">
                        <h5 class="card-title">Number of Users</h5>
                        <p class="card-text">{{ $usersCount }}</p>
                    </div>
                </div>
            </div>

            <!-- عدد المدراء -->
            <div class="col-md-4 mb-4">
                <div class="card bg-light text-center">
                    <div class="card-body">
                        <h5 class="card-title">Number of Admins</h5>
                        <p class="card-text">{{ $adminsCount }}</p>
                    </div>
                </div>
            </div>

            <!-- العناصر حسب التصنيفات الموجودة -->
            @foreach($categories as $category)
            <div class="col-md-4 mb-4">
                <div class="card bg-light text-center">
                    <div class="card-body">
                        <h5 class="card-title">Items in {{ $category->name }}</h5>
                        <p class="card-text">{{ $category->products_count }}</p>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- إجمالي المبيعات -->
            <div class="col-md-12 mb-4">
                <div class="card bg-light text-center">
                    <div class="card-body">
                        <h5 class="card-title">Total Sales</h5>
                        <p class="card-text">${{ number_format($totalSales, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('admin.index') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <svg width="25" viewBox="0 0 25 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <!-- SVG محتوى الـ -->
                </svg>
            </span>
            <span class="app-brand-text demo menu-text fw-bold ms-2">Admin Panel</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm d-flex align-items-center justify-content-center"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item {{ request()->routeIs('admin.index') ? 'active' : '' }}">
            <a href="{{ route('admin.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-smile"></i>
                <div class="text-truncate">Dashboard</div>
            </a>
        </li>

        <!-- Manage Users -->
        <li class="menu-item {{ request()->routeIs('users.index') ? 'active' : '' }}">
            <a href="{{ route('users.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div class="text-truncate">Manage Users</div>
            </a>
        </li>

        <!-- Manage Categories -->
        <li class="menu-item {{ request()->routeIs('categories.index') ? 'active' : '' }}">
            <a href="{{ route('categories.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-category"></i>
                <div class="text-truncate">Manage Categories</div>
            </a>
        </li>

        <!-- Manage Reviews -->
        <li class="menu-item {{ request()->routeIs('reviews.index') ? 'active' : '' }}">
            <a href="{{ route('reviews.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-comment"></i>
                <div class="text-truncate">Manage Reviews</div>
            </a>
        </li>

        <!-- Chat -->
        <li class="menu-item {{ request()->routeIs('admin.chat') ? 'active' : '' }}">
            <a href="{{ route('admin.chat') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-chat"></i>
                <div class="text-truncate">Chat</div>
            </a>
        </li>

        <!-- Email -->
        <li class="menu-item {{ request()->routeIs('admin.email') ? 'active' : '' }}">
            <a href="{{ route('admin.email') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-envelope"></i>
                <div class="text-truncate">Email</div>
            </a>
        </li>
    </ul>
</aside>
