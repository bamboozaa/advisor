@extends('layouts.app')
@section('title', 'ข้อมูลอาจารย์ที่ปรึกษาวิทยานิพนธ์ และการค้นคว้าอิสระ')

@section('importcss')
    @parent
    {{ Html::style('css/custom.css') }}
    {{-- {{ Html::style('css/bootstrap.min.css') }} --}}
    {{ Html::style('css/dataTables.bootstrap5.min.css') }}
@stop

@section('importjs')
    @parent
    {{ Html::script('js/jquery-3.7.1.js') }}
    {{-- {{ Html::script('js/bootstrap.bundle.min.js') }} --}}
    {{ Html::script('js/dataTables.js') }}
    {{ Html::script('js/dataTables.bootstrap5.js') }}
    <script type="module">
        @if (session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success'
            });
        @endif
        new DataTable('#example');
    </script>
@stop

@section('sidemenu')
    @include('layouts.sidemenu')
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row justify-content-end">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Advisors') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-" style="text-align: right!important;">
                {{-- <a href="{{ route('advisors.create') }}" class="btn btn-primary mb-2">
                    <i class="bi bi-plus-square"></i><span class="ms-2">{{ __('Create New') }}</span>
                </a> --}}
            </div>
        </div>
        <div class="row justify-content-end">

            <div class="card bg-white">
                <div class="card-header mt-1 text-center" style="border-bottom: 0 !important;">
                    <!-- <i class="bi bi-border-all fs-6 me-2"></i> --><span style="color: #2e3191; font-size: 1.25rem; line-height: 1.75rem;">{{ __('ข้อมูลอาจารย์ที่ปรึกษาวิทยานิพนธ์ และการค้นคว้าอิสระ') }}</span>
                </div>
                <div class="card-body" style="padding: 0rem !important;">
                    <div class="table-responsive mt-3" style="overflow-x: hidden">
                        <table id="example" class="table table-bordered table-hover" style="font-size: 1rem; line-height: 1.5rem;">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center text-nowrap align-middle" rowspan="2">{{ __('No.') }}</th>
                                    <th class="text-nowrap align-middle text-center" rowspan="2">{{ __('ชื่อ - นามสกุล') }}</th>
                                    <th class="text-center text-nowrap" colspan="2">{{ __('จำนวนภาระงานที่ปรึกษาวิทยานิพนธ์และการค้นคว้าอิสระ') }}</th>

                                    <th class="text-center text-nowrap" colspan="3">{{ __('สถานะ') }}</th>
                                    <th rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th class="text-center text-nowrap" style="width: 10%">{{ __('วิทยานิพนธ์ (Thesis)') }}</th>
                                    <th class="text-center text-nowrap" style="width: 10%">{{ __('การค้นคว้าอิสระ (IS)') }}</th>

                                    <th class="text-center text-nowrap" style="width: 10%;">{{ __('ระหว่าง') }}</th>
                                    <th class="text-center text-nowrap" style="width: 10%;">{{ __('ผ่าน') }}</th>
                                    <th class="text-center text-nowrap" style="width: 10%;">{{ __('ไม่ผ่าน') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($advisors) > 0)
                                    @foreach ($advisors as $key => $advisor)
                                        <tr>
                                            <td class="text-center">{{ 1 + $key++ }}</td>
                                            <td class="text-nowrap">
                                                <a href="{{ route('advisors.show2', $advisor) }}" class="link-offset-2 link-underline link-underline-opacity-0">
                                                    {{ (!isset($advisor->academic['academic']) ? '' : $advisor->academic['academic'] . ' ') . (!isset($advisor->qualification['abbreviation']) ? '' : $advisor->qualification['abbreviation'] . ' ') . $advisor->adv_fname . ' ' . $advisor->adv_lname }}
                                                </a>
                                            </td>
                                            @php
                                                $thesiscount = 0;
                                                $iscount = 0;
                                                $i = 0;
                                                $p = 0;
                                                $f = 0;
                                            @endphp

                                            @foreach ($advisor->projects as $project)

                                                @if ($project['project'] == 1 )
                                                    @php $thesiscount++; @endphp
                                                @endif

                                                @if ($project['project'] == 2 )
                                                    @php $iscount++; @endphp
                                                @endif

                                                @if ($project['project_status'] == 0 )
                                                    @php $i++; @endphp
                                                @endif

                                                @if ($project['project_status'] == 1 )
                                                    @php $p++; @endphp
                                                @endif

                                                @if ($project['project_status'] == 2 )
                                                    @php $f++; @endphp
                                                @endif

                                            @endforeach
                                            <td class="text-center">
                                                {{ $thesiscount > 0 ? $thesiscount : '' }}
                                            </td>
                                            <td class="text-center">
                                                {{ $iscount > 0 ? $iscount : '' }}
                                            </td>


                                            <td class="text-center">{{ $i > 0 ? $i : '' }}</td>
                                            <td class="text-center">{{ $p > 0 ? $p : '' }}</td>
                                            <td class="text-center">{{ $f > 0 ? $f : '' }}</td>
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button class="btn btn-transparent p-0 dark:text-high-emphasis" type="button"
                                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a href="{{ route('advisors.show2', $advisor) }}" class="dropdown-item text-info">info</a>
                                                    </div>
                                                </div>
                                                {{-- <a href="{{ route('advisors.show', $advisor->id) }}" class="btn btn-sm btn-info">
                                                    <i class="bi bi-info-circle"></i></a> --}}
                                                {{-- <a href="{{ route('advisors.edit', $advisor->id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="bi bi-pencil-square fs-sm"></i>
                                                    <span class="ms-1">{{ __('Edit') }}</span>
                                                </a> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">{{ __('ไม่พบข้อมูลที่ท่านต้องการค้นหาในขณะนี้') }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')

    @include('footer')

@endsection