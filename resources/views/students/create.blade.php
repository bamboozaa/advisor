@extends('layouts.app')
@section('title', 'Create New Student')

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
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('students') }}">{{ __('Students') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Create Student') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-3" style="text-align: right!important;">
                <a href="{{ url('students') }}" class="btn btn-primary mb-2">
                    <i class="bi bi-back"></i><span class="ms-2">{{ __('Back') }}</span>
                </a>
            </div>
        </div>

        <main role="main" class="row justify-content-center">
            {!! Form::open([
                'method' => 'post',
                'action' => ['App\Http\Controllers\StudentController@store'],
                'files' => true,
            ]) !!}
            <div class="card">
                <div class="card-header">
                    <h5><span style="color: green"><strong>เพิ่ม</strong></span> ข้อมูลนักศึกษาใหม่</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th class="text-end" scope="col">{{ __('รหัสนักศึกษา') }}<span style="color: red">*</span></th>
                                    <td>
                                        <input class="form-control form-control-sm w-auto" type="text" name="student_id">
                                    </td>
                                    <th class="text-end" scope="col">{{ __('คำนำหน้าชื่อ') }}</th>
                                    <td>
                                        <input class="form-control form-control-sm w-auto" type="text" name="std_title">
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-end" scope="col">ชื่อ<span style="color: red">*</span></th>
                                    <td>
                                        <input class="form-control form-control-sm" type="text" name="std_fname">
                                    </td>
                                    <th class="text-end" scope="col">นามสกุล<span style="color: red">*</span></th>
                                    <td>
                                        <input class="form-control form-control-sm" type="text" name="std_lname">
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-end" scope="col">คณะ<span style="color: red">*</span></th>
                                    <td>
                                        <input class="form-control form-control-sm" type="text" name="facultyname">
                                    </td>
                                    <th class="text-end" scope="col">สาขาวิชา<span style="color: red">*</span></th>
                                    <td>
                                        <input class="form-control form-control-sm" type="text" name="programname">
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-end" scope="col">{{ __('ปีการศึกษา') }}<span style="color: red">*</span></th>
                                    <td>
                                        <select class="form-select form-select-sm w-auto" name="academic_year" id="year">
                                            <option value="">Select Year</option>
                                        </select>
                                    </td>
                                    <th class="text-end" scope="col">ภาคการศึกษา<span style="color: red">*</span></th>
                                    <td>
                                        {!! Form::select(
                                            'semester',
                                            [1 => 'ปีการศึกษาที่ 1', 2 => 'ปีการศึกษาที่ 2'],
                                            1,
                                            ['class' => 'form-select form-select-sm w-auto']
                                        ) !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td></td>
                                    <th class="text-end" scope="col">สถานะนักศึกษา</th>
                                    <td>
                                        {!! Form::select('status', [
                                            1 => 'กำลังศึกษา',
                                            2 => 'สำเร็จการศึกษา'
                                        ], 1, [
                                            'class' => 'form-select form-select-sm w-auto',
                                        ]) !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-start pt-4" colspan="4">ข้อมูลการทำงานวิจัย วิทยานิพนธ์/การค้นคว้าอิสระ</th>
                                </tr>
                                <tr>
                                    <th class="text-end" scope="col">อาจารย์ที่ปรึกษา<span style="color: red">*</span></th>
                                    <td>
                                        {!! Form::select('adv_id', [0 => 'Please select']+ $advisors->toArray(), 0, ['class' => 'form-select form-select-sm w-auto']) !!}
                                    </td>
                                    <th class="text-end" scope="col">งานวิจัยทางด้านวิชาการ<span style="color: red">*</span></th>
                                    <td>{!! Form::select('project',
                                        [0 => 'ยังไม่ได้เลือกประเภทงานวิจัย', 1 => 'วิทยานิพนธ์ (Thesis)', 2 => 'การค้นคว้าอิสระ (IS)'],
                                        0,
                                        ['class' => 'form-select form-select-sm w-auto'],
                                    ) !!}</td>
                                </tr>
                                <tr>
                                    <th class="align-top text-end" scope="col">หัวข้องานวิจัย<span style="color: red">*</span></th>
                                    <td colspan="3">{!! Form::textarea('title_research', null, ['class' => 'form-control form-control-sm align-top', 'rows' => '4']) !!}</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row justify-content-center">
                        <div class="d-grid col-sm-3">
                            <button class="btn btn-primary" type="submit" name="submit">
                                <i class="bi bi-floppy pe-2"></i><span>บันทึก</span>
                            </button>
                        </div>
                        <div class="d-grid col-sm-3">
                            <button class="btn btn-danger" type="reset">
                                <i class="bi bi-x-circle pe-2"></i><span>ยกเลิก</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!--</form>-->
            {!! Form::close() !!}

        </main>
    </div>

    <script type="text/javascript">
        const d = new Date();
        for (y = d.getFullYear()-7; y <= d.getFullYear()+7; y++) {
            var optn = document.createElement("OPTION");
            optn.text = y;
            optn.value = y;

            // if year is 2015 selected

            if (y == d.getFullYear()) {
                optn.selected = true;
            }

            document.getElementById('year').options.add(optn);
        }
    </script>
@endsection

@section('footer')

    @include('footer')

@endsection
