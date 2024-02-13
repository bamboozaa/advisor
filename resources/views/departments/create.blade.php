@extends('layouts.app')
@section('title', 'Create New Department')

@section('importcss')
    @parent
    {{ Html::style('css/custom.css') }}
@stop

@section('sidemenu')
    @include('layouts.sidemenu')
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('departments') }}">{{ __('Departments') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Create Department') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-3" style="text-align: right!important;">
                <a href="{{ url('departments') }}" class="btn btn-primary mb-2">
                    <i class="bi bi-back"></i><span class="ms-2">{{ __('Back') }}</span>
                </a>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-white">
                    <div class="card-body">
                        <form method="POST" action="{{ route('departments.store') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="dep_name"
                                    class="col-sm-3 col-form-label text-end">{{ __('ชื่อหน่วยงาน :') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" name="dep_name" class="form-control" />
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-floppy2-fill fs-sm"></i>
                                        <span class="ms-2">{{ __('บันทึก') }}</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')

    @include('footer')

@endsection
