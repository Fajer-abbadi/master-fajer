<!-- Navbar -->

<nav
class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
id="layout-navbar">
<div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
  <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
    <i class="bx bx-menu bx-md"></i>
  </a>
</div>

<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
  <!-- Search -->
  <div class="navbar-nav align-items-center">
    <div class="nav-item d-flex align-items-center">
        <form id="search-form" class="d-flex align-items-center" onsubmit="return false;">
            <i class="bx bx-search bx-md" id="search-icon" style="cursor: pointer;"></i>
            <input type="text" name="query" id="search-input" class="form-control border-0 shadow-none ps-1 ps-sm-2" placeholder="Search..." aria-label="Search..." required>
        </form>
    </div>
</div>

<script>
    document.getElementById('search-input').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault(); // منع إعادة التحميل الافتراضي للنموذج
            performSearch();
        }
    });

    document.getElementById('search-icon').addEventListener('click', function () {
        performSearch();
    });

    function performSearch() {
        let query = document.getElementById('search-input').value.toLowerCase().trim();

        // خريطة المسارات
        const pages = {
            "dashboard": "{{ route('admin.index') }}",
            "manage categories": "{{ route('categories.index') }}",
            "manage products": "{{ route('products.index') }}",
            "manage orders": "{{ route('orders.index') }}",
            "manage coupons": "{{ route('coupons.index') }}",
            "manage status": "{{ route('status.index') }}",
            "manage blog": "{{ route('admin.blog.index') }}",
            "chat": "{{ route('admin.chat', ['receiverId' =>1])  }}",
            "user dashboard": "{{ route('user.dashboard') }}"
        };

        // تحقق من وجود المدخلات ضمن العناصر الموجودة
        if (pages[query]) {
            window.location.href = pages[query]; // إعادة التوجيه للصفحة المطلوبة
        } else {
            alert("No matching page found."); // رسالة تنبيه في حال لم يتم العثور على مطابقة
        }
    }
</script>
  <!-- /Search -->

  <ul class="navbar-nav flex-row align-items-center ms-auto">
    <!-- Place this tag where you want the button to render. -->

    <!-- User -->
    <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a
          class="nav-link dropdown-toggle hide-arrow p-0"
          href="javascript:void(0);"
          data-bs-toggle="dropdown"
        >
            <div class="avatar avatar" style="background-color: #6B429C; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 50%; color: #fff; font-weight: bold; font-size: 18px;">
                <!-- عرض الحرف الأول من اسم الآدمن -->
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a class="dropdown-item" href="#">
                <div class="d-flex">
                  <div class="flex-shrink-0 me-3">
                    <div class="avatar avatar-" style="background-color: #4a76a8; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 50%; color: #fff; font-weight: bold; font-size: 18px;">
                        <!-- نفس الأفاتار الذي يعرض الحرف الأول من اسم الآدمن -->
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                  </div>
                  <div class="flex-grow-1">
                    <h6 class="mb-0">{{ auth()->user()->name }}</h6>
                    <small class="text-muted">Admin</small>
                  </div>
                </div>
              </a>
            </li>
            <li>
              <div class="dropdown-divider my-1"></div>
            </li>
            <li>
              <a class="dropdown-item" href="{{ route('login2') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bx bx-power-off bx-md me-3"></i><span>Log Out</span>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
            </li>
        </ul>
    </li>

    <!--/ User -->
  </ul>
</div>
</nav>

<!-- / Navbar -->
