@extends('layouts.app')
@section('title', 'Create New Faculty')

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
                        <li class="breadcrumb-item"><a href="{{ url('faculties') }}">{{ __('Faculties') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Create Faculty') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-3" style="text-align: right!important;">
                <a href="{{ url('faculties') }}" class="btn btn-primary mb-2">
                    <i class="bi bi-back"></i><span class="ms-2">{{ __('Back') }}</span>
                </a>
            </div>
        </div>

        {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-white">
                    <div class="card-body">
                        <form method="POST" action="{{ route('faculties.store') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="fac_name"
                                    class="col-sm-3 col-form-label text-end">{{ __('ชื่อหลักสูตร/คณะ :') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" name="fac_name"
                                        class="form-control @error('fac_name') is-invalid @enderror" />

                                    @error('fac_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="dep_id" class="col-sm-3 col-form-label text-end">
                                    {{ __('หน่วยงาน :') }}
                                </label>
                                <div class="col-sm-auto">
                                    {!! Form::select('dep_id', $departments, null, [
                                        'class' => 'form-select',
                                        'placeholder' => 'Please Select ...',
                                    ]) !!}

                                    {{-- <select class="form-select @error('dep_id') is-invalid @enderror" name="dep_id"
                                        aria-label="Select Department">
                                        <option value="">Open this select menu</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->dep_name }}</option>
                                        @endforeach
                                    </select> --}}

                                    @error('dep_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
