@extends('layouts.app')
@section('title', 'ข้อมูลนักศึกษา')

@section('importcss')
    @parent
    {{ Html::style('css/custom.css') }}
    {{-- {{ Html::style('css/bootstrap.min.css') }} --}}
    {{ Html::style('css/dataTables.bootstrap5.min.css') }}
@stop

@section('importjs')
    @parent
    {{-- <script type="module" src="js/dataTables.bootstrap5.min.js"></script>
    <script type="module" src="js/jquery.dataTables.min.js"></script> --}}
    {{ Html::script('js/jquery-3.7.0.js') }}
    {{ Html::script('js/dataTables.bootstrap5.min.js') }}
    {{ Html::script('js/jquery.dataTables.min.js') }}
    <script type="module">
        @if (session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success'
            });
        @endif
        new DataTable('#example');
    </script>
@stop

@section('sidemenu')
    @include('layouts.sidemenu')
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row justify-content-end">
            <div class="col-md-9">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/home">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Students') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-3" style="text-align: right!important;">
                <a href="{{ route('students.create') }}" class="btn btn-primary mb-2">
                    <i class="bi bi-plus-square"></i><span class="ms-2">{{ __('Create New') }}</span>
                </a>
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="card bg-white">
                <div class="card-header mt-1">
                    <i class="bi bi-border-all fs-6 me-2"></i>{{ __('ข้อมูลนักศึกษา') }}
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-3">
                        <table id="example" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center text-nowrap align-middle">{{ __('รหัสนักศึกษา') }}</th>
                                    <th class="text-nowrap align-middle text-center">
                                        {{ __('ชื่อ - นามสกุล') }}</th>
                                    <th class="text-center text-nowrap">
                                        {{ __('อาจารย์ที่ปรึกษา') }}</th>
                                    <th class="text-center text-nowrap align-middle">{{ __('งานวิจัย') }}</th>
                                    <th class="text-center align-middle">{{ __('เรื่อง') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($students) > 0)
                                    @foreach ($students as $student)
                                        <tr>
                                            <td class="text-center">{{ $student->student_id }}</td>
                                            <td class="text-nowrap">{{ $student->std_fname . " " . $student->std_lname }}</td>
                                            <td class="text-nowrap">{{ $student->projectAdvisor['adv_fname'] . " " . $student->projectAdvisor['adv_lname'] }}</td>
                                            <td class="text-center">{{ $student->project['project'] === 1 ? "Thesis" : "IS"}}</td>
                                            <td>{{ $student->project['title_research'] }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                <tr>
                                    <td colspan="5"></td>
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
