@extends('layouts.app')
@section('title', 'Welcome to Advisers System 1.2')

@section('importcss')
    @parent
    {{ Html::style('css/custom.css') }}
@stop

@section('sidemenu')
    @include('layouts.sidemenu')
@endsection

@section('content')
    {{-- Banner Image --}}
    <div class="px-10 d-flex justify-content-cente banner-image"
        style="height: calc(100vh - 765px); background-color: blue; border-radius: 1rem;">

    </div>
    {{-- /  Banner Image --}}

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><span class="ms-1">
                    <h2>{{ __('Dashboard') }}</h2>
                </span></li>
        </ol>
    </nav>

    <!-- Card -->
    <div class="row px-3">
        <div class="card bg-white">
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-2 g-4">

                    <div class="col">
                        <a href="{{ url('advisors') }}" style="text-decoration:none;">
                            <div class="card bg-white" style="border-left-width: thick; border-left-color: #2e3191;">
                                <div class="card-body flex items-center">
                                    <div class="row">
                                        <div class="col text-center">
                                            <i class="bi bi-people text-primary" style="font-size: 3rem"></i>
                                            <br>
                                            <span class="text-nowrap" style="color: #333 !important; font-size: 1rem;">
                                                {{ __('จำนวนอาจารย์ที่ปรึกษา') }}
                                            </span>
                                        </div>
                                        <div class="col text-end py-8">
                                            <span style="color: #2e3191; font-size: 3rem;">
                                                {{-- {{ count($advisors) . " / " . count($advisors_project) }} --}}
                                                {{ count($advisors) }}
                                            </span>
                                            {{-- <br />
                                            <span style="font-size: 1rem">{{ __('อยู่ระหว่าดำเนินการ : ') }}</span>
                                            <br />
                                            <span style="font-size: 1rem">{{ __('ผ่าน : ') . count($advisors_project) }}</span>
                                            <br />
                                            <span style="font-size: 1rem">{{ __('ไม่ผ่าน') }}</span> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col">
                        <a href="{{ url('students') }}" style="text-decoration:none;">
                            <div class="card bg-white" style="border-left-width: thick; border-left-color: #2e3191;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col text-center">
                                            <i class="bi bi-people text-success" style="font-size: 3rem"></i>
                                            <br>
                                            <span style="color: #333 !important; font-size: 1rem;">
                                                {{ __('จำนวนนักศึกษา') }}
                                            </span>
                                        </div>
                                        <div class="col text-end">
                                            <span style="color: #2e3191; font-size: 3rem;">
                                                {{-- {{ count($students) . " / " . count($students_pass) }} --}}
                                                {{ count($students) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
        </ol>
        <span class="ms-1">
            <h2>{{ __('จำนวนนักศึกษาแยกตามคณะวิชา') }}</h2>
        </span>
        </li>
        </ol>
    </nav>

    <div class="row px-3">
        <div class="card bg-white">
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-4 g-3">
                    <div class="col">
                        <a href="{{ route('students.show_dep', 1) }}" style="text-decoration:none;">
                            <div class="card bg-white" style="border-left-width: thick; border-left-color: #f58c6c;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 text-center">
                                            <i class="bi bi-diagram-3"
                                                style="color: #f58c6c !important; font-size: 3rem;"></i>
                                        </div>
                                        <div class="col-8 text-center" style="color: #2e3191 !important;">

                                            <span style="font-size: 3rem;">{{ count($gs) }}</span>
                                            <br />
                                            <span style="font-size: 1rem">{{ __('บัณฑิตวิทยาลัย') }}</span>
                                        </div>
                                        <span style="font-size: 1rem"><i class="bi bi-broadcast text-primary fs-4 me-2"></i>{{ __('อยู่ระหว่างทำโครงการ : ') . count($gs) - count($gs_pass) }}</span>
                                        <span style="font-size: 1rem"><i class="bi bi-broadcast text-success fs-4 me-2"></i>{{ __('ผ่าน : ') . count($gs_pass) }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col">
                        <a href="{{ route('students.show_dep', 2) }}" style="text-decoration:none;">
                            <div class="card bg-white" style="border-left-width: thick; border-left-color: #ffc809;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 text-center">
                                            <i class="bi bi-diagram-3"
                                                style="color: #ffc809 !important; font-size: 3rem;"></i>
                                        </div>
                                        <div class="col-8 text-center" style="color: #2e3191 !important;">
                                            <span style="font-size: 3rem;">{{ count($ism) }}</span>
                                            <br />
                                            <span style="font-size: 1rem">{{ __('วิทยาลัยนานาชาติ') }}</span><br>
                                        </div>
                                        <span style="font-size: 1rem"><i class="bi bi-broadcast text-primary fs-4 me-2"></i>{{ __('อยู่ระหว่างทำโครงการ : ') . count($ism) - count($ism_pass) }}</span>
                                        <span style="font-size: 1rem"><i class="bi bi-broadcast text-success fs-4 me-2"></i>{{ __('ผ่าน : ') . count($ism_pass) }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col">
                        <a href="{{ route('students.show_dep', 3) }}" style="text-decoration:none;">
                            <div class="card bg-white" style="border-left-width: thick; border-left-color: #53b7e8;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 text-center">
                                            <i class="bi bi-diagram-3"
                                                style="color: #53b7e8 !important; font-size: 3rem;"></i>
                                        </div>
                                        <div class="col-8 text-center" style="color: #2e3191 !important;">
                                            <span style="font-size: 3rem;">
                                                {{ count($exs) }}
                                            </span>
                                            <br>
                                            <span style="font-size: 1rem">{{ __('วิทยพัฒน์') }}</span>
                                        </div>
                                        <span style="font-size: 1rem"><i class="bi bi-broadcast text-primary fs-4 me-2"></i>{{ __('อยู่ระหว่างทำโครงการ : ') . count($exs) - count($exs_pass) }}</span>
                                        <span style="font-size: 1rem"><i class="bi bi-broadcast text-success fs-4 me-2"></i>{{ __('ผ่าน : ') . count($exs_pass) }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col">
                        <a href="{{ route('students.show_dep', 4) }}" style="text-decoration:none;">
                            <div class="card bg-white" style="border-left-width: thick; border-left-color: #054463;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 text-center">
                                            <i class="bi bi-diagram-3"
                                                style="color: #054463 !important; font-size: 3rem;"></i>
                                        </div>
                                        <div class="col-8 text-center" style="color: #2e3191 !important;">
                                            <span style="font-size: 3rem;">{{ count($tcism) }}</span>
                                            <br />
                                            <span style="font-size: 1rem">{{ __('วิทยาลัยฯ ไทย-จีน') }}</span>
                                        </div>
                                        <span style="font-size: 1rem"><i class="bi bi-broadcast text-primary fs-4 me-2"></i>{{ __('อยู่ระหว่างทำโครงการ : ') . count($tcism) - count($tcism_pass) }}</span>
                                        <span style="font-size: 1rem"><i class="bi bi-broadcast text-success fs-4 me-2"></i>{{ __('ผ่าน : ') . count($tcism_pass) }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')

    @include('footer')

@endsection
