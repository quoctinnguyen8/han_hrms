<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="/velzon/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="/velzon/images/logo-dark.png" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="/velzon/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="/velzon/images/logo-light.png" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                {{-- load menu từ config.adminmenu.php và hiển thị --}}
                @php
                    $menu = config('adminmenu');
                @endphp

                @foreach ($menu as $m)
                    @if (isset($m['title']))
                        <li class="menu-title"><span data-key="t-{{ $m['title'] }}">{{ $m['title'] }}</span></li>
                        @continue
                    @endif
                    @if (!empty($m['children']))
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebar{{ $m['key'] }}" data-bs-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="sidebar{{ $m['key'] }}">
                                <i class="{{ $m['icon'] }}"></i> <span
                                    data-key="{{ $m['key'] }}">{{ $m['name'] }}</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebar{{ $m['key'] }}">
                                <ul class="nav nav-sm flex-column">
                                    @foreach ($m['children'] as $child)
                                        <li class="nav-item">
                                            <a href="{{ $child['route'] == '#' ? '#' : route($child['route']) }}"
                                                class="nav-link" data-key="{{ $child['key'] }}">
                                                {{ $child['name'] }} </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    @elseif(isset($m['is_account_mnt']) && Auth::guard('admin')->user()->is_account_mnt)
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{ $m['route'] == '#' ? '#' : route($m['route']) }}">
                                <i class="{{ $m['icon'] }}"></i> <span
                                    data-key="{{ $m['key'] }}">{{ $m['name'] }}</span>
                            </a>
                        </li>
                    @else
                        @if (!isset($m['is_account_mnt']))
                            <li class="nav-item">
                                <a class="nav-link menu-link"
                                    href="{{ $m['route'] == '#' ? '#' : route($m['route']) }}">
                                    <i class="{{ $m['icon'] }}"></i> <span
                                        data-key="{{ $m['key'] }}">{{ $m['name'] }}</span>
                                </a>
                            </li>
                        @endif
                    @endif
                @endforeach

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
    <input type="hidden" id="sidebar-key" value="@yield('sidebar-key', '')">
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var sidebarKey = document.getElementById('sidebar-key').value;
            if (sidebarKey) {
                var sidebarElement = document.querySelector('[data-key="' + sidebarKey + '"]');
                // check thẻ là span hay a
                if (sidebarElement.tagName === 'SPAN') {
                    sidebarElement = sidebarElement.closest('a').classList.add('active');
                } else {
                    sidebarElement.classList.add('active');
                }

                // check thẻ cha: nếu là thẻ a thì tìm đến thẻ cha dropdown
                if (sidebarElement.closest('.collapse')) {
                    sidebarElement.closest('.collapse').classList.add('show');
                    sidebarElement.closest('.collapse').previousElementSibling.classList.add('active');
                }
            }
        });
    </script>
</div>
