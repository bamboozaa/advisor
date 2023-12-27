<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0" style="background-color: #2e2f82;">
    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 min-vh-100">
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
            {{-- <li class="nav-item">
                <a href="#" class="nav-link align-middle px-0 text-white">
                    <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                </a>
            </li> --}}
            <li>
                <a href="{{ route('home') }}" class="nav-link px-0 align-middle text-white {{ request()->routeIs('home') ? 'active' : '' }}">
                    <i class="fs-5 bi-speedometer2"></i><span class="ms-2 d-none d-sm-inline">{{ __('Dashboard') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('advisors.index') }}" class="nav-link px-0 align-middle text-white {{ request()->routeIs('advisors.*') ? 'active' : '' }}">
                    <i class="bi bi-people-fill fs-5"></i><span class="ms-2 d-none d-sm-inline">{{ __('ข้อมูลอาจารย์ที่ปรึกษา') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('students.index') }}" class="nav-link px-0 align-middle text-white {{ request()->routeIs('students.*') ? 'active' : '' }}">
                    <i class="bi bi-people fs-5"></i><span class="ms-2 d-none d-sm-inline">{{ __('ข้อมูลนักศึกษา') }}</span>
                </a>
            </li>
            {{-- <li class="text-nowrap">
                <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-white {{ request()->routeIs('advisers.*') ? 'active' : '' }}">
                    <i class="bi bi-people fs-5"></i>
                    <span class="ms-1 d-none d-sm-inline">{{ __('ข้อมูลอาจารย์ที่ปรึกษา') }}</span>
                    <i class="bi bi-caret-down"></i>
                </a>
                <ul class="collapse nav flex-column ms-1 {{ request()->routeIs('advisers.*') ? 'show' : '' }}" id="submenu2" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="#" class="nav-link px-0 text-white ms-2 {{ request()->routeIs('advisers.create') ? 'active' : '' }}"><i class="bi bi-plus-lg fs-6"></i><span
                                class="d-none d-sm-inline ms-2">{{ __('สร้างอาจารย์ที่ปรึกษาใหม่') }}</span></a>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-0 text-white ms-2 {{ request()->routeIs('advisers.index') ? 'active' : '' }}"><i class="bi bi-display fs-6"></i><span
                                class="d-none d-sm-inline ms-2">{{ __('แสดงรายชื่ออาจารย์ที่ปรึกษา') }}</span></a>
                    </li>
                </ul>
            </li> --}}
            {{-- <li>
                <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-white">
                    <i class="fs-5 bi-people"></i><span class="ms-2 d-none d-sm-inline">{{ __('ข้อมูลนักศึกษา') }}</span> <i
                        class="bi bi-caret-down"></i>
                </a>
                <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="#" class="nav-link px-0 text-white ms-2"><i class="bi bi-plus-lg fs-6"></i><span
                                class="d-none d-sm-inline ms-2">{{ __('เพิ่มข้อมูลนักศึกษา') }}</span></a>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-0 text-white ms-2"><i class="bi bi-display fs-6"></i><span
                                class="d-none d-sm-inline ms-2">{{ __('แสดงรายชื่อนักศึกษา') }}</span></a>
                    </li>
                </ul>
            </li>--}}
            <li>
                {{-- <a href="#submenu4" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-white {{ request()->routeIs('academics.*') || request()->routeIs('qualifications.*') ? 'active' : '' }}"> --}}
                <a href="#submenu4" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-white">
                    <i class="bi bi-gear fs-5"></i><span class="ms-2 d-none d-sm-inline">{{ __('ตั้งค่าระบบ') }}</span> <i
                        class="bi bi-caret-down"></i>
                </a>
                <ul class="collapse nav flex-column ms-1 {{ request()->routeIs('academics.*') || request()->routeIs('qualifications.*') ? 'show' : '' }}" id="submenu4" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="{{ route('academics.index') }}" class="nav-link px-0 text-white ms-2 {{ request()->routeIs('academics.*') ? 'active' : '' }}">
                            <i class="bi bi-sliders fs-6"></i>
                            <span class="d-none d-sm-inline ms-2">{{ __('ตำแหน่งทางวิชาการ') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('qualifications.index') }}" class="nav-link px-0 text-white ms-2 {{ request()->routeIs('qualifications.*') ? 'active' : '' }}">
                            <i class="bi bi-sliders fs-6"></i>
                            <span class="d-none d-sm-inline ms-2">{{ __('วุฒิการศึกษา') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
            {{-- <li>
                <a href="{{ route('academics.index') }}" class="nav-link px-0 align-middle text-white {{ request()->routeIs('academics.*') ? 'active' : '' }}">
                    <i class="fs-5 bi bi-trophy"></i> <span class="ms-2 d-none d-sm-inline">{{ __('ตำแหน่งทางวิชาการ') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('qualifications.index') }}" class="nav-link px-0 align-middle text-white {{ request()->routeIs('qualifications.*') ? 'active' : '' }}">
                    <i class="bi bi-mortarboard fs-5"></i><span class="ms-2 d-none d-sm-inline">{{ __('วุฒิการศึกษา') }}</span>
                </a>
            </li> --}}
        </ul>
    </div>
</div>
