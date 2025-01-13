@extends('layouts.app')
@section('title', 'ข้อมูลอาจารย์ที่ปรึกษาวิทยานิพนธ์ และการค้นคว้าอิสระ')

@section('importcss')
    @parent
    {{ Html::style('css/custom.css') }}
    {{-- {{ Html::style('css/bootstrap.min.css') }} --}}
    {{-- {{ Html::style('css/dataTables.bootstrap5.min.css') }} --}}
@stop

@section('importjs')
    @parent
    {{-- {{ Html::script('js/jquery-3.7.1.js') }} --}}
    {{-- {{ Html::script('js/bootstrap.bundle.min.js') }} --}}
    {{-- {{ Html::script('js/dataTables.js') }}
    {{ Html::script('js/dataTables.bootstrap5.js') }} --}}
    <script type="module">
        @if (session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success'
            }).then((result) => {
                let timerInterval;
                Swal.fire({
                    title: "Please wait...!",
                    // html: "I will close in <b></b> milliseconds.",
                    timer: 1000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                        const timer = Swal.getPopup().querySelector("b");
                        timerInterval = setInterval(() => {
                            // timer.textContent = `${Swal.getTimerLeft()}`;
                        }, 100);
                    },
                    willClose: () => {
                        clearInterval(timerInterval);
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log("I was closed by the timer");
                    }
                });
            });
        @elseif (!session('error'))
            let timerInterval;
            Swal.fire({
                title: "Please wait...!",
                // html: "I will close in <b></b> milliseconds.",
                timer: 1000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector("b");
                    timerInterval = setInterval(() => {
                        // timer.textContent = `${Swal.getTimerLeft()}`;
                    }, 100);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                }
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    console.log("I was closed by the timer");
                }
            });
        @endif

        // new DataTable('#example');
    </script>
@stop

@section('sidemenu')
    @include('layouts.sidemenu')
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row justify-content-end">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Advisors') }}</li>
                    </ol>
                </nav>
            </div>
            {{-- <div class="col text-end">
                <a href="#" class="text-success"><i class="bi bi-file-earmark-excel-fill fs-4 shadow"></i></a>
                <a href="#" class="text-danger"><i class="bi bi-file-pdf-fill fs-4 shadow"></i></a>
            </div> --}}
        </div>
        <div class="row justify-content-end">
            <div class="card bg-white">
                <div class="card-header mt-1 text-center" style="border-bottom: 0 !important;">
                    <!-- <i class="bi bi-border-all fs-6 me-2"></i> --><span
                        style="color: #2e3191; font-size: 1.25rem; line-height: 1.75rem;">{{ __('รายงานข้อมูลอาจารย์ที่ปรึกษาวิทยานิพนธ์ และการค้นคว้าอิสระ') }}</span>
                </div>
                <form method="GET" action="{{ route('report-advisors.index') }}" enctype="multipart/form-data">
                    @csrf
                    <section class="py-3">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-floating">
                                    <select name="status" class="form-select" id="floatingSelectGrid"
                                        aria-label="Floating label select example">
                                        <option selected>Open this select menu</option>
                                        <option value="0">Not Active</option>
                                        <option value="1">Active</option>
                                    </select>
                                    <label for="floatingSelectGrid">
                                        สถานะอาจารย์ที่ปรึกษา
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-floating">
                                    <select name="project_status" class="form-select" id="project_status"
                                        aria-label="Floating label select project_status">
                                        <option value="" selected>Open this select menu</option>
                                        <option value="0">อยู่ระหว่างดำเนินการ</option>
                                        <option value="1">ผ่าน</option>
                                        <option value="2">ไม่ผ่าน</option>
                                    </select>
                                    <label for="project_status">สถานะโครงการ</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-floating">
                                    <select name="project" class="form-select" id="project"
                                        aria-label="Floating label select project">
                                        <option value="" selected>Open this select menu</option>
                                        <option value="1">วิทยานิพนธ์</option>
                                        <option value="2">การค้นคว้าอิสระ</option>
                                    </select>
                                    <label for="project">ประเภทโครงการ</label>
                                </div>
                            </div>
                            <div class="col-lg-3 d-grid mx-auto text-center" style="width: 200px">
                                <button type="submit" class="btn btn-primary rounded"
                                    type="button">{{ __('ค้นหา') }}</button>
                            </div>
                        </div>
                    </section>
                </form>
                <div class="card-body" style="padding: 0rem !important;">
                    <div class="table-responsive" style="overflow-x: hidden">
                        <table id="example" class="table table-bordered table-hover"
                            style="font-size: 1rem; line-height: 1.5rem;">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center text-nowrap align-middle" rowspan="2">
                                        <div class="position-relative">
                                            {{ __('No.') }}
                                            <span
                                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                {{ count($advisors) }}
                                                <span class="visually-hidden">unread messages</span>
                                            </span>
                                        </div>
                                    </th>
                                    <th class="text-nowrap align-middle text-center" rowspan="2">
                                        {{ __('ชื่อ - นามสกุล') }}</th>
                                    <th class="text-center text-nowrap" colspan="2">
                                        {{ __('จำนวนภาระงานที่ปรึกษาวิทยานิพนธ์และการค้นคว้าอิสระ') }}
                                    </th>
                                    @if (Auth::user()->role == 1)
                                    <th class="text-center text-nowrap" colspan="3">
                                        {{ __('สถานะ') }}
                                    </th>
                                    <th rowspan="2"></th>

                                        <th rowspan="2"></th>
                                    @endif

                                </tr>
                                <tr>
                                    <th class="text-center text-nowrap" style="width: 10%">{{ __('วิทยานิพนธ์ (Thesis)') }}
                                    </th>
                                    <th class="text-center text-nowrap" style="width: 10%">{{ __('การค้นคว้าอิสระ (IS)') }}
                                    </th>

                                    <th class="text-center text-nowrap" style="width: 10%;">{{ __('กำลังดำเนินการ') }}</th>
                                    <th class="text-center text-nowrap" style="width: 10%;">{{ __('ผ่าน') }}</th>
                                    <th class="text-center text-nowrap" style="width: 10%;">{{ __('ไม่ผ่าน') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($advisors) > 0)
                                    @php
                                        $n = 1;
                                    @endphp
                                    @foreach ($advisors as $key => $advisor)
                                        <tr>
                                            <td class="text-center">{{ $n++ }}</td>
                                            <td class="text-nowrap">
                                                <a href="{{ route('report-advisors.show', $advisor) }}"
                                                    class="link-offset-2 link-underline link-underline-opacity-0">
                                                    {{ (!isset($advisor->academic['academic']) ? '' : $advisor->academic['academic'] . ' ') . (!isset($advisor->qualification['abbreviation']) ? '' : $advisor->qualification['abbreviation'] . ' ') . $advisor->adv_fname . ' ' . $advisor->adv_lname }}
                                                </a>

                                                {{-- {{ (!isset($advisor->academic['academic']) ? '' : $advisor->academic['academic'] . ' ') . (!isset($advisor->qualification['abbreviation']) ? '' : $advisor->qualification['abbreviation'] . ' ') . $advisor->adv_fname . ' ' . $advisor->adv_lname }} --}}
                                            </td>
                                            @php
                                                $thesiscount = 0;
                                                $iscount = 0;
                                                $i = 0;
                                                $p = 0;
                                                $f = 0;
                                            @endphp

                                            @foreach ($advisor->projects as $project)
                                                @if ($project['project'] == 1)
                                                    @php $thesiscount++; @endphp
                                                @endif

                                                @if ($project['project'] == 2)
                                                    @php $iscount++; @endphp
                                                @endif

                                                @if ($project['project_status'] == 0)
                                                    @php $i++; @endphp
                                                @endif

                                                @if ($project['project_status'] == 1)
                                                    @php $p++; @endphp
                                                @endif

                                                @if ($project['project_status'] == 2)
                                                    @php $f++; @endphp
                                                @endif
                                            @endforeach
                                            <td class="text-center">
                                                {{ $thesiscount > 0 ? $thesiscount : '' }}
                                            </td>
                                            <td class="text-center">
                                                {{ $iscount > 0 ? $iscount : '' }}
                                            </td>


                                            <td class="text-center">{{ $i > 0 ? $i : '' }}</td>
                                            <td class="text-center">{{ $p > 0 ? $p : '' }}</td>
                                            <td class="text-center">{{ $f > 0 ? $f : '' }}</td>
                                            <td class="text-center">
                                                @if ($advisor->status === 1)
                                                    <span class="badge rounded-pill bg-success">{{ __('Active') }}</span>
                                                @endif

                                                @if ($advisor->status === 0)
                                                    <span
                                                        class="badge rounded-pill bg-danger">{{ __('Not Active') }}</span>
                                                @endif

                                            </td>
                                            {{-- @if (Auth::user()->role == 1 || Auth::user()->role == 2)
                                                <td class="text-center">
                                                    <div class="dropdown">
                                                        <button class="btn btn-transparent p-0 dark:text-high-emphasis"
                                                            type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="bi bi-three-dots-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a href="{{ route('report-advisors.show', $advisor) }}" class="dropdown-item text-info">info</a>
                                                            <a href="{{ route('report-advisors.edit', $advisor) }}" class="dropdown-item text-warning">{{ __('Edit') }}</a>
                                                            <form action="{{ route('report-advisors.destroy', $advisor) }}" method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-danger"
                                                                    onclick="return confirm('Are you sure you want to delete this department?')">
                                                                    {{ __('Delete') }}
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            @endif --}}
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">{{ __('ไม่พบข้อมูลที่ท่านต้องการค้นหาในขณะนี้') }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')

    @include('footer')

@endsection
