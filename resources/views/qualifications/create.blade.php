@extends('layouts.app')
@section('title', 'Create New Qualification')

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
                        <li class="breadcrumb-item"><a href="{{ url('qualifications') }}">{{ __('Qualifications') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Create Qualification') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-3" style="text-align: right!important;">
                <a href="{{ url('qualifications') }}" class="btn btn-primary mb-2">
                    <i class="bi bi-back"></i><span class="ms-2">{{ __('Back') }}</span>
                </a>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-white">
                    <div class="card-body">
                        <form method="POST" action="{{ route('qualifications.store') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="qualification" class="col-sm-3 col-form-label text-end">{{ __('วุฒิการศึกษา :') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" name="qualification" class="form-control" required />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="abbreviation" class="col-sm-3 col-form-label text-end">{{ __('ชื่อย่อ :') }}</label>
                                <div class="col-sm-auto">
                                    <input type="text" name="abbreviation" class="form-control" />
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
