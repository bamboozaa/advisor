@extends('layouts.app')
@section('title', 'Edit Advisor')

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
                        <li class="breadcrumb-item"><a href="{{ url('advisors') }}">{{ __('Advisors') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Edit Advisor') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-3" style="text-align: right!important;">
                <a href="{{ url('advisors') }}" class="btn btn-primary mb-2">
                    <i class="bi bi-back"></i><span class="ms-2">{{ __('Back') }}</span>
                </a>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <form method="POST" action="{{ route('reports.update', old('name', $advisor->id)) }}" enctype="multipart/form-data">
                    @csrf
                    {{-- @method('UPDATE') --}}
                    <div class="card bg-white">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <font color="#DC3545"><strong>{{ __('แก้ไข') }}</strong></font>
                                {{ __('ข้อมูลอาจารย์ที่ปรึกษาวิทยานิพนธ์ และการค้นคว้าอิสระใหม่') }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="px-lg-4">
                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <label for="adv_id" class="form-label">{{ __('รหัสอาจารย์ที่ปรึกษา') }}</label>
                                        <input type="text" name="adv_id" class="form-control text-info" value="{{ old('name', $advisor->adv_id) }}" />
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="adv_title" class="form-label">{{ __('คำนำหน้าชื่อตามบัตรประชาชน') }}</label>
                                        <input type="text" name="adv_title" class="form-control text-info" value="{{ old('name', $advisor->adv_title) }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <label for="adv_fname" class="form-label">{{ __('ชื่อ') }}</label>
                                        <input type="text" name="adv_fname" class="form-control text-info" value="{{ old('name', $advisor->adv_fname) }}" />
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="adv_lname" class="form-label">{{ __('นามสกุล') }}</label>
                                        <input type="text" name="adv_lname" class="form-control text-info" value="{{ old('name', $advisor->adv_lname) }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <label for="academic" class="form-label">
                                            {{ __('ตำแหน่งทางวิชาการ') }}
                                        </label>
                                        {!! Form::select('aca_id', $academics, old('name', $advisor->aca_id), ['class' => 'form-select text-info', 'placeholder' => 'Please Select ...']) !!}
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="qualification" class="form-label">
                                            {{ __('วุฒิการศึกษา') }}
                                        </label>
                                        {!! Form::select('qua_id', $qualifications, old('name', $advisor->qua_id), [
                                            'class' => 'form-select text-info',
                                            'placeholder' => 'Please Select ...',
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-auto">
                                        <label for="academic" class="form-label">
                                            {{ __('Status') }}
                                        </label>
                                        {!! Form::select('status', [1 => 'Active', 0 => 'Not Active'], old('name', $advisor->status), ['class' => 'form-select text-info', 'placeholder' => 'Please Select ...']) !!}
                                    </div>
                                    <div class="col-lg-6">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="px-lg-4">
                                <div class="row justify-content-center">
                                    <div class="d-grid col-md-3">
                                        <button class="btn btn-success" type="submit">
                                            <i class="bi bi-arrow-up-square fs-sm me-2"></i><span>{{ __('อัพเดท') }}</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer')

    @include('footer')

@endsection
