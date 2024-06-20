@extends('layouts.app')
@section('title', 'Edit Student')

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
                        <li class="breadcrumb-item"><a href="{{ url('students', $student->id) }}">{{ $student->std_title . " " . $student->std_fname . " " . $student->std_lname }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Edit Student') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-3" style="text-align: right!important;">
                <a href="{{ url()->previous() }}" class="btn btn-primary mb-2">
                    <i class="bi bi-back"></i><span class="ms-2">{{ __('Back') }}</span>
                </a>
            </div>
        </div>

        <main role="main" class="row justify-content-center">
            {{-- {!! Form::open([
                'method' => 'post',
                'action' => ['App\Http\Controllers\StudentController@update', $student->id],
                'files' => true,
            ]) !!} --}}
            <form method="POST" action="{{ route('students.update', old('name', $student->id)) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="card">
                <div class="card-header mt-2">
                    <h5><span style="color: red"><strong>{{ __('แก้ไข') }}</strong></span> {{ __('ข้อมูลนักศึกษา') }}</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th class="text-end w-10" scope="col">{{ __('รหัสนักศึกษา') }}</th>
                                    <td class="w-25">
                                        {!! Form::text('student_id', old('name', $student->student_id), ['class' => 'form-control form-control-sm w-auto text-info']) !!}
                                    </td>
                                    <th class="text-end w-10" scope="col">{{ __('คำนำหน้าชื่อ') }}</th>
                                    <td class="w-25">
                                        {!! Form::text('std_title', old('name', $student->std_title), ['class' => 'form-control form-control-sm w-auto text-info']) !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-end" scope="col">{{ __('ชื่อ') }}</th>
                                    <td>
                                        {!! Form::text('std_fname', old('name', $student->std_fname), ['class' => 'form-control form-control-sm text-info']) !!}
                                    </td>
                                    <th class="text-end" scope="col">{{ __('นามสกุล') }}</th>
                                    <td>
                                        {!! Form::text('std_lname', old('name', $student->std_lname), ['class' => 'form-control form-control-sm text-info']) !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-end" scope="col">{{ __('หน่วยงาน') }}</th>
                                    <td>
                                        {!! Form::select('dep_id', $departments, old('name', $student->dep_id), [
                                            'class' => 'form-select form-select-sm w-auto',
                                            'placeholder' => 'Please Select ...',
                                        ]) !!}
                                        {{-- {!! Form::text('facultyname', old('name', $student->facultyname), ['class' => 'form-control form-control-sm text-info']) !!} --}}
                                    </td>
                                    <th class="text-end" scope="col">{{ __('หลักสูตร/คณะ') }}</th>
                                    <td>
                                        {!! Form::select('fac_id', $faculties, null, ['class' => 'form-select form-select-sm w-auto', 'placeholder' => 'Please Select ...']) !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-end" scope="col">{{ __('สาขาวิชา/กลุ่มวิชา') }}</th>
                                    <td>
                                        {{-- {!! Form::text('major', old('name', $student->major), ['class' => 'form-control form-control-sm text-info']) !!} --}}
                                        {!! Form::select('major_id', $majors, old('name', $student->major), ['class' => 'form-select form-select-sm text-info w-auto', 'placeholder' => 'Please Select ...']) !!}
                                    </td>
                                    <th class="text-end" scope="col">{{ __('ปีการศึกษา') }}</th>
                                    <td>
                                        {!! Form::select('academic_year', ["" => 'Select Year'], old('name', $student->academic_year), ['class' => 'form-select form-select-sm text-info w-auto', 'id' => 'year', 'data-my-data' => $student->academic_year]) !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-end" scope="col">{{ __('ภาคการศึกษา') }}</th>
                                    <td>
                                        {!! Form::select('semester', [1 => '1', 2 => '2', 3 => '3'], old('name', $student->semester), ['class' => 'form-select form-select-sm text-info w-auto']) !!}
                                    </td>
                                    <th class="text-end" scope="col">{{ __('สถานะนักศึกษา') }}</th>
                                    <td>
                                        {!! Form::select('status', [
                                            1 => 'กำลังศึกษา',
                                            2 => 'สำเร็จการศึกษา'
                                        ], old('name', $student->status), [
                                            'class' => 'form-select form-select-sm text-info w-auto'
                                        ]) !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-start pt-4" colspan="4">{{ __('ข้อมูลการทำงานวิจัย วิทยานิพนธ์/การค้นคว้าอิสระ') }}</th>
                                </tr>
                                <tr>
                                    <th class="text-end" scope="col">{{ __('อาจารย์ที่ปรึกษา') }}</th>
                                    <td>
                                        {!! Form::select('adv_id', [0 => 'Please select']+ $advisors->toArray(), old('name', $student->project['adv_id']), ['class' => 'form-select form-select-sm text-info w-auto', 'disabled']) !!}
                                    </td>
                                    <th class="text-end" scope="col">{{ __('งานวิจัยทางด้านวิชาการ') }}</th>
                                    <td>{!! Form::select('project',
                                        [0 => 'ยังไม่ได้เลือกประเภทงานวิจัย', 1 => 'วิทยานิพนธ์ (Thesis)', 2 => 'การค้นคว้าอิสระ (IS)'],
                                        old('name', $student->project['project']),
                                        ['class' => 'form-select form-select-sm text-info w-auto', 'disabled'],
                                    ) !!}</td>
                                </tr>
                                <tr>
                                    <th class="align-top text-end" scope="col">{{ __('หัวข้องานวิจัย (ภาษาไทย)') }}</th>
                                    <td colspan="3">{!! Form::textarea('title_research', old('name', $student->project['title_research']), ['class' => 'form-control form-control-sm text-info align-top', 'rows' => '4']) !!}</td>
                                </tr>
                                <tr>
                                    <th class="align-top text-end" scope="col">{{ __('หัวข้องานวิจัย (ภาษาอังกฤษ)') }}</th>
                                    <td colspan="3">{!! Form::textarea('title_research_en', old('name', $student->project['title_research_en']), ['class' => 'form-control form-control-sm text-info align-top', 'rows' => '4']) !!}</td>
                                </tr>
                                <tr>
                                    <th class="text-end" scope="col">{{ __('แหล่งตีพิมพ์') }}</th>
                                    <td>
                                        {!! Form::text('publisher', old('name', $student->project['publisher']), ['class' => 'form-control form-control-sm text-info']) !!}
                                    </td>
                                    <th class="text-end" scope="col">{{ __('ปีที่ตีพิมพ์') }}</th>
                                    <td>
                                        {!! Form::text('publishing_year', old('name', $student->project['publishing_year']), ['class' => 'form-control form-control-sm w-auto text-info']) !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-end" scope="col">{{ __('สถานะ') }}</th>
                                    <td>
                                        {!! Form::select(
                                            'project_status',
                                            [0 => 'อยู่ระหว่างดำเนินการ', 1 => 'ผ่าน', 2 => 'ไม่ผ่าน'],
                                            old('name', $student->project['project_status']),
                                            ['class' => 'form-select form-select-sm text-info w-auto']
                                        ) !!}
                                    </td>
                                    <th class="text-end" scope="col"></th>
                                    <td></td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row justify-content-center">
                        <div class="d-grid col-sm-3">
                            <button class="btn btn-success" type="submit" name="submit">
                                <i class="bi bi-floppy fs-sm pe-2"></i>
                                {{ __('อัพเดท') }}
                            </button>
                        </div>
                        <div class="d-grid col-sm-3">
                            <form action="{{ route('students.destroy', old('name', $student->id)) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?')">
                                    <i class="bi bi-trash fs-sm pe-2"></i>
                                    {{ __('Delete') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </form>
            {{-- {!! Form::close() !!} --}}

        </main>
    </div>

    <script type="text/javascript">
        const d = new Date();
        const myData = document.getElementById('year').getAttribute('data-my-data');
        for (y = (d.getFullYear()-7) + 543; y <= (d.getFullYear()+7) + 543; y++) {
            var optn = document.createElement("OPTION");
            optn.text = y;
            optn.value = y;

            // if year is 2015 selected

            if (y == myData) {
                optn.selected = true;
            }

            document.getElementById('year').options.add(optn);
        }
    </script>
@endsection

@section('footer')

    @include('footer')

@endsection
