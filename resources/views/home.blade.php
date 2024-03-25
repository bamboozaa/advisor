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



    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><span class="ms-1">{{ __('Dashboard') }}</span></li>
        </ol>
    </nav>

    <!-- Card -->
    <div class="row px-3">
        <div class="card bg-white">
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <div class="col">
                        <div class="card bg-white" style="border-left-width: thick; border-left-color: #2e3191;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 text-center">
                                        {{-- <i class="bi bi-mortarboard text-primary" style="font-size: 40px"></i> --}}
                                        <i class="bi bi-people text-primary" style="font-size: 40px"></i>
                                    </div>
                                    <div class="col-8 text-right">
                                        <span class="right">
                                            <div>
                                                <a href="{{ url('advisors') }}" style="font-size: 26px; text-decoration:none;">
                                                    <span>{{ count($advisors) }}</span>
                                                    {{-- <span>50</span> --}}
                                                </a>
                                            </div>
                                            <div>
                                                <span>{{ __('จำนวนอาจารย์ที่ปรึกษา') }}</span>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card bg-white" style="border-left-width: thick; border-left-color: #2e3191;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <i class="bi bi-people text-success" style="font-size: 40px"></i>
                                    </div>
                                    <div class="col-8 text-right">
                                        <span class="right">
                                            <div>
                                                <a href="{{ url('students') }}" style="font-size: 26px; text-decoration:none;">
                                                    {{-- <span>{{ $student_count }}</span> --}}
                                                    <span>{{ count($students) }}</span>
                                                </a>
                                            </div>
                                            <div>{{ __('จำนวนนักศึกษา') }}</div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        {{-- <div class="card bg-white">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <i class="bi bi bi-trophy text-warning fs-1" ></i>
                                    </div>
                                    <div class="col-8 text-right">
                                        <span class="right">
                                            <div>
                                                <a href="{{ url('academics') }}" style="font-size: 26px; text-decoration:none;">
                                                    <span>{{ count($academics) }}</span>
                                                </a>
                                            </div>
                                            <div>{{ __('ตำแหน่งทางวิชาการ') }}</div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <nav aria-label="breadcrumb" class="pt-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><span class="ms-1">{{ __('จำนวนนักศึกษาแยกตามคณะวิชา') }}</span></li>
        </ol>
    </nav>

    <div class="row px-3">
        <div class="card bg-white">
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-4 g-3">
                    <div class="col">
                        <div class="card bg-white" style="border-left-width: thick; border-left-color: #f58c6c;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <i class="bi bi-diagram-3 fs-1" style="color: #f58c6c !important;"></i>
                                    </div>
                                    <div class="col-8 text-right">
                                        <span class="right">
                                            <div>
                                                <a href="{{ url('students') }}" style="font-size: 26px; text-decoration:none;">
                                                    <span>{{ count($gs) }}</span>

                                                </a>
                                            </div>
                                            <div>
                                                <span>{{ __('บัณฑิตวิทยาลัย') }}</span>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card bg-white" style="border-left-width: thick; border-left-color: #ffc809;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <i class="bi bi-diagram-3 fs-1" style="color: #ffc809 !important;"></i>
                                    </div>
                                    <div class="col-8 text-right">
                                        <span class="right">
                                            <div>
                                                <a href="{{ url('students') }}" style="font-size: 26px; text-decoration:none;">
                                                    <span>{{ count($ism) }}</span>
                                                </a>
                                            </div>
                                            <div>{{ __('วิทยาลัยนานาชาติ') }}</div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card bg-white" style="border-left-width: thick; border-left-color: #53b7e8;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <i class="bi bi-diagram-3 fs-1" style="color: #53b7e8 !important;"></i>
                                    </div>
                                    <div class="col-8 text-right">
                                        <span class="right">
                                            <div>
                                                <a href="{{ url('students') }}" style="font-size: 26px; text-decoration:none;">
                                                    <span>{{ count($exs) }}</span>
                                                </a>
                                            </div>
                                            <div>{{ __('วิทยพัฒน์') }}</div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card bg-white" style="border-left-width: thick; border-left-color: #054463;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <i class="bi bi-diagram-3 fs-1" style="color: #054463 !important;"></i>
                                    </div>
                                    <div class="col-8 text-right">
                                        <span class="right">
                                            <div>
                                                <a href="{{ url('students') }}" style="font-size: 26px; text-decoration:none;">
                                                    <span>{{ count($tcism) }}</span>
                                                </a>
                                            </div>
                                            <div>{{ __('วิทยาลัยฯ ไทย-จีน') }}</div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col">
                        <div class="card bg-white" style="border-left-width: thick; border-left-color: #523996;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <i class="bi bi-diagram-3 fs-2" ></i>
                                    </div>
                                    <div class="col-8 text-right">
                                        <span class="right">
                                            <div>
                                                <a href="{{ url('students') }}" style="font-size: 26px; text-decoration:none;">
                                                    <span>{{ count($harbour) }}</span>
                                                </a>
                                            </div>
                                            <div>{{ __('Harbour Space') }}</div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')

    @include('footer')

@endsection
