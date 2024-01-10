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
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ (!isset($advisor->academic['abbreviation']) ? '' : old('name', $advisor->academic['abbreviation']) . ' ') . old('name', $advisor->qualification['abbreviation']) . ' ' . old('name', $advisor->adv_fname) . ' ' . old('name', $advisor->adv_lname) }}
                        </li>
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

            <div class="card bg-white">
                <div class="card-header mt-2">
                    <h5 class="mb-0">
                        <font color="#2596be"><strong>{{ __('แสดง') }}</strong></font>
                        {{ __('ข้อมูลอาจารย์ที่ปรึกษาวิทยานิพนธ์ และการค้นคว้าอิสระ') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="px-lg-4">
                        <div class="row mb-3">
                            <!-- Table Advisers -->
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th class="text-left" scope="col" colspan="4">
                                            {{ __('ข้อมูลอาจารย์ที่ปรึกษา') }}</th>
                                    </tr>
                                    <tr>
                                        <th class="align-middle text-end" style="background-color: #0c8ccc" scope="col">
                                            {!! Form::label('adv_title', 'คำนำหน้าชื่อ', ['class' => 'form-control-plaintext text-light']) !!}</th>
                                        <td>
                                            {!! Form::text('adv_title', old('name', $advisor->adv_title), ['class' => 'form-control col-md-4', 'readonly']) !!}
                                        </td>
                                        <th class="align-middle text-end" style="background-color: #0c8ccc" scope="col">
                                            {!! Form::label('adv_academic', 'ตำแหน่งทางวิชาการ', ['class' => 'form-control-plaintext text-light']) !!}</th>
                                        <td>{!! Form::text(
                                            'adv_academic',
                                            !isset($advisor->academic['academic']) ? '' : old('name', $advisor->academic['academic']),
                                            [
                                                'class' => 'form-control',
                                                'readonly',
                                            ],
                                        ) !!}</td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle text-end" style="background-color: #0c8ccc" scope="col">
                                            {!! Form::label('adv_fname', 'ชื่อ - นามสกุล', ['class' => 'form-control-plaintext text-light']) !!}</th>
                                        <td>{!! Form::text(
                                            'adv_fname',
                                            old('name', $advisor->qualification['abbreviation']) .
                                                ' ' .
                                                old('name', $advisor->adv_fname) .
                                                ' ' .
                                                old('name', $advisor->adv_fname),
                                            [
                                                'class' => 'form-control',
                                                'readonly',
                                            ],
                                        ) !!}</td>
                                        <th class="align-middle text-end" style="background-color: #0c8ccc" scope="col">
                                            {!! Form::label('abbreviation', 'ตัวย่อ', ['class' => 'form-control-plaintext text-light']) !!}</th>
                                        <td>{!! Form::text(
                                            'abbreviation',
                                            !isset($advisor->academic['abbreviation']) ? '' : old('name', $advisor->academic['abbreviation']),
                                            [
                                                'class' => 'form-control',
                                                'readonly',
                                            ],
                                        ) !!}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-3">
            <div class="card bg-white">
                <div class="card-body">
                    <div class="px-lg-4">
                        <div class="row mb-3">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-home" type="button" role="tab"
                                        aria-controls="nav-home" aria-selected="true">{{ __('รายชื่อนักศึกษา') }}
                                    </button>
                                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-profile" type="button" role="tab"
                                        aria-controls="nav-profile" aria-selected="false">{{ __('ประวัติการศึกษา') }}
                                    </button>
                                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-contact" type="button" role="tab"
                                        aria-controls="nav-contact" aria-selected="false">{{ __('หลักสูตรที่ประจำหรือสอน') }}
                                    </button>
                                    <button class="nav-link" id="nav-contact2-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-contact2" type="button" role="tab"
                                        aria-controls="nav-contact2" aria-selected="false">{{ __('ผลงานทางวิชาการ') }}
                                    </button>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <table class="table table-hover table-sm">
                                        <thead class="bg-light">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th class="text-nowrap" scope="col">รหัสนักศึกษา</th>
                                                <th scope="col" class="text-nowrap">ชื่อ - นามสกุล</th>
                                                <th style="white-space:nowrap" scope="col">ปีการศึกษา/ภาค</th>
                                                <th style="white-space:nowrap" scope="col">งานวิจัยทางวิชาการ</th>
                                                <th width="100%" scope="col">หัวข้องานวิจัยเรื่อง</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-light">
                                            @if (count($advisor->projects) > 0)
                                                @foreach ($advisor->projects as $key => $project)
                                                    <tr>
                                                        <td class="align-top">{{ $key + 1 }}</td>
                                                        <td class="align-top">
                                                            <a href="{{ route('students.show', $project->student['id']) }}">{{ $project->student_id }}</a>
                                                        </td>
                                                        <td class="text-nowrap">
                                                            {{ $project->student['std_title'] . ' ' . $project->student['std_fname'] . ' ' . $project->student['std_lname'] }}
                                                        </td>
                                                        <td class="text-center">{{ $project->student['academic_year'] . '/' . $project->student['semester'] }}</td>
                                                        <td style="white-space:nowrap" class="align-top text-left">
                                                            {{ $project['project'] === 1 ? 'วิทยานิพนธ์' : '' }}
                                                            {{ $project['project'] === 2 ? 'ค้นคว้าอิสระ' : '' }}</td>
                                                        <td class="text-left">{{ $project['title_research'] }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td class="text-left" colspan="6"><mark><span
                                                                class="text-danger">* ไม่พบข้อมูลที่ท่านต้องการค้นหา
                                                                !!!</span></mark></td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                    aria-labelledby="nav-profile-tab">...
                                </div>
                                <div class="tab-pane fade" id="nav-contact" role="tabpanel"
                                    aria-labelledby="nav-contact-tab">...
                                </div>
                                    <div class="tab-pane fade" id="nav-contact2" role="tabpanel"
                                    aria-labelledby="nav-contact2-tab">
                                    contact2
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')

    @include('footer')

@endsection
