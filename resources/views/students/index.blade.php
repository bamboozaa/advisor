@extends('layouts.app')
@section('title', 'ข้อมูลนักศึกษา')

@section('importcss')
    @parent
    {{ Html::style('css/custom.css') }}
    {{-- {{ Html::style('css/bootstrap.min.css') }} --}}
    {{-- {{ Html::style('css/dataTables.bootstrap5.min.css') }} --}}
@stop

@section('importjs')
    @parent
    {{-- <script type="module" src="js/dataTables.bootstrap5.min.js"></script>
    <script type="module" src="js/jquery.dataTables.min.js"></script> --}}
    {{-- {{ Html::script('js/jquery-3.7.1.js') }} --}}
    {{-- {{ Html::script('js/bootstrap.bundle.min.js') }} --}}
    {{-- {{ Html::script('js/dataTables.bootstrap5.min.js') }} --}}
    {{-- {{ Html::script('js/jquery.dataTables.min.js') }} --}}
    {{-- {{ Html::script('js/dataTables.js') }}
    {{ Html::script('js/dataTables.bootstrap5.js') }} --}}
    <script type="module">
        @if (session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success'
            });
        @endif

        // DataTable.ext.errMode = 'throw';
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
                    <!-- <i class="bi bi-border-all fs-6 me-2"></i> --><span style="color: #2e3191; font-size: 1.25rem; line-height: 1.75rem;">{{ __('ข้อมูลนักศึกษา') }}</span>
                </div>
                <div class="card-body" style="padding: 0rem !important;">
                    <div class="table-responsive mt-3" style="overflow-x: hidden">
                        <table id="tbl_students" class="table table-striped table-bordered table-hover" style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="text-center text-nowrap align-middle">{{ __('#') }}</th>
                                    <th class="text-center text-nowrap align-middle">{{ __('รหัสนักศึกษา') }}</th>
                                    <th class="text-nowrap align-middle text-center">
                                        {{ __('ชื่อ - นามสกุล') }}</th>
                                    <th class="text-nowrap align-middle text-center">{{ __('คณะวิชา') }}</th>
                                    <th class="text-center text-nowrap">
                                        {{ __('อาจารย์ที่ปรึกษา') }}</th>
                                    <th class="text-center text-nowrap align-middle">{{ __('งานวิจัย') }}</th>
                                    <th class="text-center align-middle">{{ __('เรื่อง') }}</th>
                                    <th class="text-center align-middle">{{ __('Status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($students) > 0)
                                    @foreach ($students as $key => $student)
                                        <tr>
                                            <td class="text-center">{{ 1 + $key++ }}</td>
                                            <td><a
                                                    href="{{ route('students.show', $student->id) }}">{{ $student->student_id }}</a>
                                            </td>
                                            <td class="text-nowrap">{{ $student->std_fname . ' ' . $student->std_lname }}
                                            </td>
                                            <td class="text-nowrap">{{ $student->department['dep_name'] }}</td>
                                            <td class="text-nowrap">
                                                {{ $student->projectAdvisor->academic['academic'] . ' ' . $student->projectAdvisor->qualification['abbreviation'] . ' ' . $student->projectAdvisor['adv_fname'] . ' ' . $student->projectAdvisor['adv_lname'] }}
                                            </td>
                                            <td class="text-center">
                                                {{ $student->project['project'] === 1 ? 'Thesis' : 'IS' }}</td>
                                            <td>{{ $student->project['title_research'] }}</td>
                                            <td class="text-center text-nowrap">
                                                @if ($student->project['project_status'] === 0)
                                                    <span class="badge rounded-pill bg-primary">{{ __('อยู่ระหว่างดำเนินการ') }}</span>
                                                @elseif ($student->project['project_status'] === 1)
                                                    <span class="badge rounded-pill bg-success">{{ __('ผ่าน') }}</span>
                                                @elseif ($student->project['project_status'] === 2)
                                                    <span class="badge rounded-pill bg-danger">{{ __('ไม่ผ่าน') }}</span>
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
