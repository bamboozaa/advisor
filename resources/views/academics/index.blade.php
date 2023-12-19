@extends('layouts.app')
@section('title', 'ข้อมูลตำแหน่งทางวิชาการ')

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
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Academics') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-3" style="text-align: right!important;">
                <a href="{{ route('academics.create') }}" class="btn btn-primary mb-2">
                    <i class="bi bi-plus-square"></i><span class="ms-2">{{ __('Create New') }}</span>
                </a>
            </div>
        </div>
        <div class="row justify-content-end">

                <div class="card bg-white">
                    <div class="card-header mt-1"><i class="bi bi-border-all fs-6 me-2"></i>{{ __('ข้อมูลตำแหน่งทางวิชาการ') }}</div>

                    <div class="card-body">
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center text-nowrap col-md-1">{{ __('No.') }}</th>
                                        <th scope="col" class="text-nowrap">{{ __('ชื่อตำแหน่งทางวิชาการ') }}</th>
                                        <th scope="col" class="text-center text-nowrap col-md-1">{{ __('ตัวย่อ') }}</th>
                                        <th scope="col" class="text-center col-md-2">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($academics) > 0)
                                        @foreach ($academics as $key => $academic)
                                            <tr>
                                                <td class="text-center">{{ $key+1 }}</td>
                                                <td>{{ $academic->academic }}</td>
                                                <td class="text-center">{{ $academic->abbreviation }}</td>
                                                <td class="text-center text-nowrap">
                                                    <a href="{{ route('academics.edit', $academic->id) }}" class="btn btn-warning btn-sm">
                                                        <i class="bi bi-pencil-square fs-sm"></i>
                                                        <span class="ms-1">{{ __('Edit') }}</span>
                                                    </a>
                                                    <form action="{{ route('academics.destroy', $academic->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this department?')">
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
