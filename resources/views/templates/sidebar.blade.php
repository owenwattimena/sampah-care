<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        {{-- <div>
            <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div> --}}
        <div>
            <h4 class="logo-text">Sampah Care</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ url('/') }}">
                <div class="parent-icon"><i class="bx bx-home"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="{{ route('pengaduan') }}">
                <div class="parent-icon"><i class="bx bx-message-rounded"></i>
                </div>
                <div class="menu-title">Pengaduan</div>
            </a>
        </li>
        @if (auth()->guard('admin')->user()->level == 'admin')

        <li>
            <a href="{{ route('pengguna') }}">
                <div class="parent-icon"><i class="bx bx-user"></i>
                </div>
                <div class="menu-title">Pengguna</div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin') }}">
                <div class="parent-icon"><i class="bx bx-user"></i>
                </div>
                <div class="menu-title">Admin</div>
            </a>
        </li>
        @endif

    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
