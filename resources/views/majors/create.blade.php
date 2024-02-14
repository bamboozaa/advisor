@extends('layouts.app')
@section('title', 'Create New Major')

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
                        <li class="breadcrumb-item"><a href="{{ url('majors') }}">{{ __('Majors') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Create Major') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-3" style="text-align: right!important;">
                <a href="{{ url('majors') }}" class="btn btn-primary mb-2">
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
                        <form method="POST" action="{{ route('majors.store') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="major_name" class="col-sm-3 col-form-label text-end">{{ __('ชื่อสาขาวิชา/กลุ่มวิชา :') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" name="major_name" class="form-control" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="fac_id" class="col-sm-3 col-form-label text-end">
                                    {{ __('หลักสูตร/คณะ :') }}
                                </label>
                                <div class="col-sm-auto">
                                    {!! Form::select('fac_id', $faculties, null, [
                                    'class' => 'form-select',
                                    'placeholder' => 'Please Select ...',
                                ]) !!}
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="major_year" class="col-sm-3 col-form-label text-end">{{ __('ปี ค.ศ. :') }}</label>
                                <div class="col-sm-auto">
                                    <input type="text" name="major_year" class="form-control" />
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
