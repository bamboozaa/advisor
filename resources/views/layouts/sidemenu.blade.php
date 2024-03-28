<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0" style="background-color: #2e2f82; font-size: 1.25rem; line-height: 1.75rem;">
    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 min-vh-100">
        <ul class="nav flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
            <li>
                <a href="{{ route('home') }}" class="nav-link px-0 align-middle text-white {{ request()->routeIs('home') ? 'active' : '' }}">
                    <i class="fs-4 bi-speedometer2"></i><span class="ms-2 d-none d-sm-inline">{{ __('Dashboard') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('advisors.index') }}" class="nav-link px-0 align-middle text-white {{ request()->routeIs('advisors.*') ? 'active' : '' }}">
                    <i class="bi bi-people-fill fs-4"></i><span class="ms-2 d-none d-sm-inline">{{ __('ข้อมูลอาจารย์ที่ปรึกษา') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('students.index') }}" class="nav-link px-0 align-middle text-white {{ request()->routeIs('students.*') ? 'active' : '' }}">
                    <i class="bi bi-people fs-4"></i><span class="ms-2 d-none d-sm-inline">{{ __('ข้อมูลนักศึกษา') }}</span>
                </a>
            </li>
            <li>
                <a href="#submenu4" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-white">
                    <i class="bi bi-gear fs-4"></i><span class="ms-2 d-none d-sm-inline">{{ __('ตั้งค่าระบบ') }}</span> <i
                        class="bi bi-caret-down"></i>
                </a>
                <ul class="collapse nav flex-column ms-1 {{ request()->routeIs('academics.*') || request()->routeIs('qualifications.*') || request()->routeIs('departments.*') || request()->routeIs('faculties.*') || request()->routeIs('majors.*') ? 'show' : '' }}" id="submenu4" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="{{ route('academics.index') }}" class="nav-link px-0 text-white ms-2 {{ request()->routeIs('academics.*') ? 'active' : '' }}">
                            <i class="bi bi-sliders fs-5"></i>
                            <span class="d-none d-sm-inline ms-2">{{ __('ตำแหน่งทางวิชาการ') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('qualifications.index') }}" class="nav-link px-0 text-white ms-2 {{ request()->routeIs('qualifications.*') ? 'active' : '' }}">
                            <i class="bi bi-sliders fs-5"></i>
                            <span class="d-none d-sm-inline ms-2">{{ __('วุฒิการศึกษา') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('departments.index') }}" class="nav-link px-0 text-white ms-2 {{ request()->routeIs('departments.*') ? 'active' : '' }}">
                            <i class="bi bi-sliders fs-5"></i>
                            <span class="d-none d-sm-inline ms-2">{{ __('หน่วยงาน') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('faculties.index') }}" class="nav-link px-0 text-white ms-2 {{ request()->routeIs('faculties.*') ? 'active' : '' }}">
                            <i class="bi bi-sliders fs-5"></i>
                            <span class="d-none d-sm-inline ms-2">{{ __('หลักสูตร/คณะ') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('majors.index') }}" class="nav-link px-0 text-white ms-2 {{ request()->routeIs('majors.*') ? 'active' : '' }}">
                            <i class="bi bi-sliders fs-5"></i>
                            <span class="d-none d-sm-inline ms-2">{{ __('สาขาวิชา/กลุ่มวิชา') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
