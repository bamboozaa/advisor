@extends('layouts.app')
@section('title', 'Create New Advisor')

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
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Create Advisor') }}</li>
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
                <form method="POST" action="{{ route('advisors.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card bg-white">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <font color="#009933"><strong>{{ __('เพิ่ม') }}</strong></font>
                                {{ __('ข้อมูลอาจารย์ที่ปรึกษาวิทยานิพนธ์ และการค้นคว้าอิสระใหม่') }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="px-lg-4">
                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <label for="adv_id" class="form-label">{{ __('รหัสอาจารย์ที่ปรึกษา') }}<span
                                                style="color: red">*</span></label>
                                        <input type="text" name="adv_id" class="form-control text-info" required />
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="adv_title" class="form-label">{{ __('คำนำหน้าชื่อตามบัตรประชาชน') }}</label>
                                        <input type="text" name="adv_title" class="form-control text-info" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <label for="adv_fname" class="form-label">{{ __('ชื่อ') }}<span
                                                style="color: red">*</span></label>
                                        <input type="text" name="adv_fname" class="form-control text-info" required />
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="adv_lname" class="form-label">{{ __('นามสกุล') }}<span
                                                style="color: red">*</span></label>
                                        <input type="text" name="adv_lname" class="form-control text-info" required />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <label for="academic" class="form-label">
                                            {{ __('ตำแหน่งทางวิชาการ') }}
                                            {{-- <span style="color: red">*</span> --}}
                                        </label>
                                        {!! Form::select('aca_id', $academics, null, ['class' => 'form-select text-info', 'placeholder' => 'Please Select ...']) !!}
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="qualification" class="form-label">
                                            {{ __('วุฒิการศึกษา') }}
                                            <span style="color: red">*</span>
                                        </label>
                                        {!! Form::select('qua_id', $qualifications, null, [
                                            'class' => 'form-select text-info',
                                            'placeholder' => 'Please Select ...',
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="px-lg-4">
                                <div class="row justify-content-center">
                                    <div class="d-grid col-md-3">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="bi bi-floppy2-fill fs-sm me-2"></i><span>{{ __('บันทึก') }}</span>
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
    </div>
@endsection

