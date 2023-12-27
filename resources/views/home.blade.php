@extends('layouts.app')
@section('title', 'Welcome to Advisers System 1.1')

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

                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <div class="col">
                        <div class="card bg-white">
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
                        <div class="card bg-white">
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
                                                    <span>50</span>
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
                        <div class="card bg-white">
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
