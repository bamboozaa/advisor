@extends('layouts.app')
@section('title', 'Edit Faculty')

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
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Edit Faculty') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-3" style="text-align: right!important;">
                <a href="{{ url('faculties') }}" class="btn btn-primary mb-2"><i class="bi bi-back fs-sm me-2"></i>{{ __('Back') }}</a>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-white">
                    <div class="card-header">{{ __('Edit Faculty') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('faculties.update', $faculty->id) }}">
                            @csrf
                            @method('PATCH')
                            <div class="row mb-3">
                                <label for="fac_name" class="col-sm-3 col-form-label text-end">{{ __('ชื่อหลักสูตร/คณะ :') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" name="fac_name" class="form-control" value="{{ old('name', $faculty->fac_name) }}" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="dep_id" class="col-sm-3 col-form-label text-end">
                                    {{ __('หน่วยงาน :') }}
                                </label>
                                <div class="col-sm-auto">
                                    {!! Form::select('dep_id', $departments, old('name', $faculty->department['id']), [
                                    'class' => 'form-select',
                                    'placeholder' => 'Please Select ...',
                                ]) !!}
                                </div>
                            </div>

                            <div class="row mb-3 mt-4 justify-content-center">
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-success"><i class="bi bi-arrow-up-circle fs-sm me-2"></i>{{ __('Update') }}</button>
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
