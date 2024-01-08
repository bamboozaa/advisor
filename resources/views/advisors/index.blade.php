@extends('layouts.app')
@section('title', 'ข้อมูลอาจารย์ที่ปรึกษาวิทยานิพนธ์ และการค้นคว้าอิสระ')

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
        <div class="row justify-content-end">
            <div class="col-md-9">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/home">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Advisors') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-3" style="text-align: right!important;">
                <a href="{{ route('advisors.create') }}" class="btn btn-primary mb-2">
                    <i class="bi bi-plus-square"></i><span class="ms-2">{{ __('Create New') }}</span>
                </a>
            </div>
        </div>
        <div class="row justify-content-end">

            <div class="card bg-white">
                <div class="card-header mt-1"><i
                        class="bi bi-border-all fs-6 me-2"></i>{{ __('ข้อมูลอาจารย์ที่ปรึกษาวิทยานิพนธ์ และการค้นคว้าอิสระ') }}
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center text-nowrap align-middle" rowspan="2">{{ __('No.') }}</th>
                                    <th class="text-nowrap align-middle text-center" rowspan="2">
                                        {{ __('ชื่อ - นามสกุล') }}</th>
                                    <th class="text-center text-nowrap" colspan="2">
                                        {{ __('จำนวนภาระงานที่ปรึกษาวิทยานิพนธ์และการค้นคว้าอิสระ') }}</th>
                                    <th class="text-center align-middle" rowspan="2">{{ __('Actions') }}</th>
                                </tr>
                                <tr>
                                    <th width="15%" class="text-center">{{ __('วิทยานิพนธ์') }}</th>
                                    <th width="15%" class="text-center">{{ __('การค้นคว้าอิสระ') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($advisors) > 0)
                                    @foreach ($advisors as $key => $advisor)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ (is_null($advisor->academic['academic']) ? $advisor->academic['academic'] . " " : "") . $advisor->academic['academic'] . $advisor->qualification['abbreviation'] . $advisor->adv_fname . ' ' . $advisor->adv_lname }}
                                            </td>
                                            @php
                                                $thesiscount = 0;
                                                $iscount = 0;
                                            @endphp
                                            <td class="text-center">
                                                {{-- {{ $advisor->projects[0]['project'] }} --}}
                                                @foreach ($advisor->projects as $project)
                                                    {{-- {{ dd($project) }} --}}
                                                    @if ($project['project'] == 1)
                                                        @php $thesiscount++; @endphp
                                                    @endif
                                                @endforeach
                                                {{-- @if ($advisor->projects[0]['project'] == 1)
                                                    @php $thesiscount ++; @endphp
                                                @endif --}}
                                                {{ $thesiscount > 0 ? $thesiscount : '' }}
                                            </td>
                                            <td class="text-center">
                                                @foreach ($advisor->projects as $project)
                                                    @if ($project['project'] == 2)
                                                        @php $iscount++; @endphp
                                                    @endif
                                                @endforeach
                                                {{ $iscount > 0 ? $iscount : '' }}
                                            </td>
                                            <td class="text-center text-nowrap">
                                                <a href="{{ route('advisors.edit', $advisor->id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="bi bi-pencil-square fs-sm"></i>
                                                    <span class="ms-1">{{ __('Edit') }}</span>
                                                </a>
                                                <form action="{{ route('advisors.destroy', $advisor->id) }}" method="POST"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this department?')">
                                                        <i class="bi bi-trash fs-sm"></i>
                                                        <span class="ms-1">{{ __('Delete') }}</span>
                                                    </button>
                                                </form>
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
