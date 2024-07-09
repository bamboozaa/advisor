@extends('layouts.app')
@section('title', 'รายงานข้อมูลนักศึกษา')

@section('importcss')
    @parent
    {{ Html::style('css/custom.css') }}
@stop

@section('importjs')
    @parent

    <script type="module">
        @if (session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success'
            });
        @endif

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
    </script>
@stop

@section('sidemenu')
    @include('layouts.sidemenu')
@endsection

@section('content')
{{-- {{ dd($students) }} --}}
    <div class="container-fluid">
        <div class="row justify-content-end">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Students') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col" style="text-align: right!important;">
                {{-- <a href="{{ route('students.create') }}" class="btn btn-primary mb-2">
                    <i class="bi bi-plus-square"></i><span class="ms-2">{{ __('Create New') }}</span>
                </a> --}}
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="card bg-white">
                <div class="card-header mt-1 text-center">
                    <span style="color: #2e3191; font-size: 1.25rem; line-height: 1.75rem;">{{ __('รายงานข้อมูลนักศึกษา') }}</span>
                </div>
                <form method="GET" action="{{ route('reports.index_students') }}" enctype="multipart/form-data">
                    @csrf
                    <section class="py-3">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-floating">
                                    {!! Form::select('fac_id', [null => 'Open this select menu'] + $faculties->toArray(), null, ['class' => 'form-select', 'id' => 'floatingSelectGrid',]) !!}
                                    <label for="floatingSelectGrid">หลักสูตร</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-floating">
                                    <select class = "form-select" name="academic_year" aria-label="Floating label select academic_year">
                                        <option value="" selected>{{ __('Open this select menu') }}</option>
                                        @for ($year = $minYear->academic_year; $year <= $maxYear->academic_year; $year++)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                    <label for="academic_year">ปีการศึกษา</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-floating">
                                    {!! Form::select('adv_id', [null => 'Open this select menu'] + $advisors->toArray(), null, ['class' => 'form-select', 'id' => 'adv_id', 'data-live-search' => 'true']) !!}
                                    <label for="adv_id">อาจารย์ที่ปรึกษา</label>
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
                    <div class="table-responsive mt-3" style="overflow-x: hidden">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center text-nowrap align-middle">
                                        <div class="position-relative">
                                            {{ __('#') }}
                                            <span
                                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                {{ count($students) }}
                                                <span class="visually-hidden">unread messages</span>
                                            </span>
                                        </div>
                                    </th>
                                    {{-- <th class="text-center text-nowrap align-middle">{{ __('รหัสนักศึกษา') }}</th> --}}
                                    <th class="text-nowrap align-middle text-center">{{ __('ชื่อ - นามสกุล') }}</th>
                                    <th class="text-nowrap align-middle text-center">{{ __('หลักสูตร') }}</th>
                                    <th class="text-nowrap align-middle text-center">{{ __('คณะวิชา') }}</th>
                                    <th class="text-center text-nowrap">{{ __('อาจารย์ที่ปรึกษา') }}</th>
                                    <th class="text-center text-nowrap align-middle">{{ __('งานวิจัย') }}</th>
                                    <th class="text-center text-nowrap align-middle">{{ __('ปีการศึกษา') }}</th>
                                    {{-- <th class="text-center align-middle">{{ __('เรื่อง') }}</th> --}}
                                    <th class="text-center align-middle">{{ __('สถานะ') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($students) > 0)
                                    @php
                                        $n = 1;
                                    @endphp
                                    @foreach ($students as $key => $student)
                                        <tr>
                                            <td class="text-center">{{ $n++ }}</td>
                                            {{-- <td>
                                                <a href="{{ route('students.show', $student->id) }}">{{ $student->student_id }}</a>
                                                {{ $student->student_id }}
                                            </td> --}}
                                            <td class="text-nowrap">{{ $student->std_fname . ' ' . $student->std_lname }}
                                            </td>
                                            <td class="text-nowrap">
                                                {{ !isset($student->faculty['fac_name']) ? '' : $student->faculty['fac_name'] }}
                                            </td>
                                            <td class="text-nowrap">{{ $student->department['dep_name'] }}</td>
                                            <td class="text-nowrap">
                                                {{ $student->projectAdvisor->academic['academic'] . ' ' . $student->projectAdvisor->qualification['abbreviation'] . ' ' . $student->projectAdvisor['adv_fname'] . ' ' . $student->projectAdvisor['adv_lname'] }}
                                            </td>
                                            <td class="text-center">
                                                @if ($student->project)
                                                    @if ($student->project === 1)
                                                        Thesis
                                                    @else
                                                        IS
                                                    @endif
                                                @else
                                                    @if ($student->project['project'] === 1)
                                                        Thesis
                                                    @else
                                                        IS
                                                    @endif
                                                @endif
                                                {{-- {{ $student->project['project'] === 1 ? 'Thesis' : 'IS' }} --}}
                                            </td>
                                            <td class="text-center">{{ $student->academic_year }}</td>
                                            {{-- <td>{{ $student->project['title_research'] }}</td> --}}
                                            <td class="text-center text-nowrap">
                                                {{-- {{ gettype($student->project_status) }}
                                                {{ $student->project_status }} --}}
                                                @if ($student->project_status || $student->project_status === 0)
                                                    @if ($student->project_status === 0)
                                                        <span class="badge rounded-pill bg-primary">{{ __('อยู่ระหว่างดำเนินการ') }}</span>
                                                    @elseif ($student->project_status === 1)
                                                        <span class="badge rounded-pill bg-success">{{ __('ผ่าน') }}</span>
                                                    @elseif ($student->project_status === 2)
                                                        <span class="badge rounded-pill bg-danger">{{ __('ไม่ผ่าน') }}</span>
                                                    @endif
                                                @else
                                                    @if ($student->project['project_status'] === 0)
                                                        <span class="badge rounded-pill bg-primary">{{ __('อยู่ระหว่างดำเนินการ') }}</span>
                                                    @elseif ($student->project['project_status'] === 1)
                                                        <span class="badge rounded-pill bg-success">{{ __('ผ่าน') }}</span>
                                                    @elseif ($student->project['project_status'] === 2)
                                                        <span class="badge rounded-pill bg-danger">{{ __('ไม่ผ่าน') }}</span>
                                                    @endif
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">ไม่พบข้อมูลที่ท่านต้องการค้นหา</td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="d-flex">
                        {{ $students->links() }}
                    </div> --}}

                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')

    @include('footer')

@endsection
