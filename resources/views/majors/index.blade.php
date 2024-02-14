@extends('layouts.app')
@section('title', 'ข้อมูลสาขาวิชา/กลุ่มวิชา')

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
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Majors') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-3" style="text-align: right!important;">
                <a href="{{ route('majors.create') }}" class="btn btn-primary mb-2">
                    <i class="bi bi-plus-square"></i><span class="ms-2">{{ __('Create New') }}</span>
                </a>
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="card bg-white">
                <div class="card-header mt-1"><i class="bi bi-border-all fs-6 me-2"></i>{{ __('ข้อมูลสาขาวิชา/กลุ่มวิชา') }}</div>
                <div class="card-body">
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center text-nowrap col-md-1">{{ __('No.') }}</th>
                                    <th scope="col" class="text-nowrap">{{ __('ชื่อสาขาวิชา/กลุ่มวิชา') }}</th>
                                    <th scope="col" class="text-nowrap">{{ __('หลักสูตร/คณะ') }}</th>
                                    <th scope="col" class="text-nowrap">{{ __('หน่วยงาน') }}</th>
                                    <th scope="col" class="text-nowrap text-center">{{ __('ปีที่เปิดหลักสูตร') }}</th>
                                    <th scope="col" class="text-center col-md-2">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($majors) > 0)
                                    @foreach ($majors as $key => $major)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $major->major_name }}</td>
                                            <td>{{ $major->faculty['fac_name'] }}</td>
                                            <td>{{ $major->faculty->department['dep_name'] }}</td>
                                            <td class="text-center">{{ $major->major_year === null ? "" : $major->major_year + 543 }}</td>
                                            <td class="text-center text-nowrap">
                                                <a href="{{ route('majors.edit', $major->id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="bi bi-pencil-square fs-sm"></i>
                                                    <span class="ms-1">{{ __('Edit') }}</span>
                                                </a>
                                                <form action="{{ route('majors.destroy', $major->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this department?')">
                                                        <i class="bi bi-trash fs-sm"></i>
                                                        <span class="ms-1">{{ __('Delete') }}</span>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">{{ __('ไม่พบข้อมูลที่ท่านต้องการค้นหาในขณะนี้') }}</td>
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
