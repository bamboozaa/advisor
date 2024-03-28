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
                        <a href="{{ url('advisors') }}" style="text-decoration:none;">
                            <div class="card bg-white" style="border-left-width: thick; border-left-color: #2e3191;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 text-center">
                                            <i class="bi bi-people text-primary" style="font-size: 3rem"></i>
                                        </div>
                                        <div class="col-8 text-end" style="color: #2e3191 !important;">
                                            <span style="font-size: 2rem;">
                                                {{ count($advisors) }}
                                            </span>
                                            <br>
                                            <span style="font-size: 1.25rem;">{{ __('จำนวนอาจารย์ที่ปรึกษา') }}</span>
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
                                        <div class="col-4 text-center">
                                            <i class="bi bi-people text-success" style="font-size: 3rem"></i>
                                        </div>
                                        <div class="col-8 text-end">
                                            <span style="font-size: 2rem;">{{ count($students) }}</span>
                                            <br>
                                            <span style="color: #2e3191 !important; font-size: 1.25rem;">{{ __('จำนวนนักศึกษา') }}</span>
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

    <nav aria-label="breadcrumb" class="pt-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <span class="ms-1">{{ __('จำนวนนักศึกษาแยกตามคณะวิชา') }}</span>
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
                                            <i class="bi bi-diagram-3" style="color: #f58c6c !important; font-size: 3rem;"></i>
                                        </div>
                                        <div class="col-8 text-center" style="color: #2e3191 !important;">
                                            <span style="font-size: 2rem;">{{ count($gs) }}</span>
                                            <br />
                                            <span style="font-size: 1rem">{{ __('บัณฑิตวิทยาลัย') }}</span>
                                        </div>
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
                                            <span style="font-size: 2rem;">{{ count($ism) }}</span>
                                            <br />
                                            <span style="font-size: 1rem">{{ __('วิทยาลัยนานาชาติ') }}</span>
                                        </div>
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
                                            <span style="font-size: 2rem;">
                                                {{ count($exs) }}
                                            </span>
                                            <br>
                                            <span style="font-size: 1rem">{{ __('วิทยพัฒน์') }}</span>
                                        </div>
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
                                            <span style="font-size: 2rem;">{{ count($tcism) }}</span>
                                            <br />
                                            <span style="font-size: 1rem">{{ __('วิทยาลัยฯ ไทย-จีน') }}</span>
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

@endsection

@section('footer')

    @include('footer')

@endsection
