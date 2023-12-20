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
                <div class="card bg-white">
                    <div class="card-header">{{ __('บันทึกข้อมูลอาจารย์ที่ปรึกษาวิทยานิพนธ์ และการค้นคว้าอิสระใหม่') }}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('advisors.store') }}">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <label for="adv_id" class="col-sm-3 col-form-label text-end">{{ __('รหัสอาจารย์ที่ปรึกษา :') }}</label>
                                        <div class="col-sm-auto">
                                            <input type="text" name="adv_id" class="form-control" required />
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <label for="adv_fname" class="col-sm-3 col-form-label text-end">{{ __('ชื่ออาจารย์ที่ปรึกษา :') }}</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="adv_fname" class="form-control" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <label for="adv_lname" class="col-sm-3 col-form-label text-end">{{ __('นามสกุลอาจารย์ที่ปรึกษา :') }}</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="adv_lname" class="form-control" required />
                                        </div>
                                    </div>
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
