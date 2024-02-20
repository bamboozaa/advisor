@extends('layouts.app')
@section('title', 'Show Student')

@section('importcss')
    @parent
    {{ Html::style('css/custom.css') }}
@stop

@section('importjs')
    @parent
    <script type="module">
        @if (session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success'
            });
        @endif
    </script>
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
                        <li class="breadcrumb-item active" aria-current="page">{{ $student->std_title . " " . $student->std_fname . " " . $student->std_lname }}</li>
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
            <div class="card">
                <div class="card-header mt-2">
                    <h5><span style="color:cornflowerblue"><strong>{{ __('แสดง') }}</strong></span>{{ __('ข้อมูลนักศึกษา') }}</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th class="text-end w-10" scope="col">{{ __('รหัสนักศึกษา') }}</th>
                                    <td class="w-25">
                                        {!! Form::text('student_id', old('name', $student->student_id), ['class' => 'form-control form-control-sm w-auto text-info', 'readonly']) !!}
                                    </td>
                                    <th class="text-end w-10" scope="col">{{ __('คำนำหน้าชื่อ') }}</th>
                                    <td class="w-25">
                                        {!! Form::text('std_title', old('name', $student->std_title), ['class' => 'form-control form-control-sm w-auto text-info', 'readonly']) !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-end" scope="col">{{ __('ชื่อ') }}</th>
                                    <td>
                                        {!! Form::text('std_fname', old('name', $student->std_fname), ['class' => 'form-control form-control-sm text-info', 'readonly']) !!}
                                    </td>
                                    <th class="text-end" scope="col">{{ __('นามสกุล') }}</th>
                                    <td>
                                        {!! Form::text('std_lname', old('name', $student->std_lname), ['class' => 'form-control form-control-sm text-info', 'readonly']) !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-end" scope="col">{{ __('หน่วยงาน') }}</th>
                                    <td>
                                        {!! Form::select('dep_id', $departments, old('name', $student->dep_id), [
                                            'class' => 'form-select form-select-sm w-auto', 'disabled',
                                            'placeholder' => 'Please Select ...',
                                        ]) !!}
                                        {{-- {!! Form::text('facultyname', old('name', $student->facultyname), ['class' => 'form-control form-control-sm text-info', 'readonly']) !!} --}}
                                    </td>
                                    <th class="text-end" scope="col">{{ __('หลักสูตร/คณะ') }}</th>
                                    <td>
                                        {!! Form::select('fac_id', $faculties, old('name', $student->fac_id), [
                                            'class' => 'form-select form-select-sm w-auto', 'disabled',
                                            'placeholder' => 'Please Select ...',
                                        ]) !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-end" scope="col">{{ __('สาขาวิชา/กลุ่มวิชา') }}</th>
                                    <td>
                                        @if (is_null($student->major))
                                            {!! Form::select('major_id', $majors, old('name', $student->major_id), ['class' => 'form-select form-select-sm text-info w-auto', 'disabled']) !!}
                                        @else
                                            {!! Form::text('major', old('name', $student->major), ['class' => 'form-control form-control-sm text-info', 'readonly']) !!}
                                        @endif
                                    </td>
                                    <th class="text-end" scope="col">{{ __('ปีการศึกษา') }}</th>
                                    <td>
                                        {!! Form::select('academic_year', ["" => 'Select Year'], old('name', $student->academic_year), ['class' => 'form-select form-select-sm text-info w-auto', 'id' => 'year', 'disabled', 'data-my-data' => $student->academic_year]) !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-end" scope="col">{{ __('ภาคการศึกษา') }}</th>
                                    <td>
                                        {!! Form::select(
                                            'semester',
                                            [1 => 'ภาคการศึกษาที่ 1', 2 => 'ภาคการศึกษาที่ 2', 3 => 'ภาคการศึกษาที่ 3'],
                                            old('name', $student->semester),
                                            ['class' => 'form-select form-select-sm text-info w-auto', 'disabled']
                                        ) !!}
                                    </td>
                                    <th class="text-end" scope="col">{{ __('สถานะนักศึกษา') }}</th>
                                    <td>
                                        {!! Form::select('status', [
                                            1 => 'กำลังศึกษา',
                                            2 => 'สำเร็จการศึกษา'
                                        ], old('name', $student->status), [
                                            'class' => 'form-select form-select-sm text-info w-auto', 'disabled'
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
                                    <th class="align-top text-end" scope="col">{{ __('หัวข้องานวิจัยภาษาไทย') }}</th>
                                    <td colspan="3">{!! Form::textarea('title_research', old('name', $student->project['title_research']), ['class' => 'form-control form-control-sm text-info align-top', 'rows' => '4', 'readonly']) !!}</td>
                                </tr>
                                <tr>
                                    <th class="align-top text-end" scope="col">{{ __('หัวข้องานวิจัยภาษาอังกฤษ') }}</th>
                                    <td colspan="3">{!! Form::textarea('title_research_en', null, ['class' => 'form-control form-control-sm text-info align-top', 'rows' => '4', 'readonly']) !!}</td>
                                </tr>
                                <tr>
                                    <th class="text-end" scope="col">{{ __('แหล่งตีพิมพ์') }}</th>
                                    <td>
                                        {!! Form::text('publisher', old('name', $student->project['publisher']), ['class' => 'form-control form-control-sm text-info', 'readonly']) !!}
                                    </td>
                                    <th class="text-end" scope="col">{{ __('ปีที่ตีพิมพ์') }}</th>
                                    <td>
                                        {!! Form::text('publishing_year', old('name', $student->project['publishing_year']), ['class' => 'form-control form-control-sm w-auto text-info', 'readonly']) !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-end" scope="col">{{ __('สถานะ') }}</th>
                                    <td>
                                        {!! Form::select(
                                            'project_status',
                                            [0 => 'อยู่ระหว่างดำเนินการ', 1 => 'ผ่าน', 2 => 'ไม่ผ่าน'],
                                            old('name', $student->project['project_status']),
                                            ['class' => 'form-select form-select-sm text-info w-auto', 'disabled']
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
                            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning"><i class="bi bi-floppy pe-2"></i><span>{{ __('แก้ไข') }}</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script type="text/javascript">
        const d = new Date();
        // const data = document.getElementById('year').value;
        const myData = document.getElementById('year').getAttribute('data-my-data');
        for (y = (d.getFullYear()-7) + 543; y <= (d.getFullYear()+5) + 543; y++) {
            var optn = document.createElement("OPTION");
            optn.text = y;
            optn.value = y;

            if (y == myData) {
                optn.selected = true;
            }

            document.getElementById('year').options.add(optn);
            // document.getElementById('year').value = old('name', $student->academic_year);
        }
    </script>
@endsection

@section('footer')

    @include('footer')

@endsection
