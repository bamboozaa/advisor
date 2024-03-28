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
                    <!-- <i class="bi bi-border-all fs-6 me-2"></i> --><span style="color: #2596be; font-size: 1.25rem; line-height: 1.75rem;">{{ __('ข้อมูลอาจารย์ที่ปรึกษาวิทยานิพนธ์ และการค้นคว้าอิสระ') }}</span>
                </div>
                <div class="card-body" style="padding: 0rem !important;">
                    <div class="table-responsive mt-3" style="overflow-x: hidden">
                        <table id="example" class="table table-bordered table-hover" style="font-size: 1rem; line-height: 1.5rem;">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center text-nowrap align-middle" rowspan="2">{{ __('No.') }}</th>
                                    <th class="text-nowrap align-middle text-center" rowspan="2">{{ __('ชื่อ - นามสกุล') }}</th>
                                    <th class="text-center text-nowrap" colspan="2">{{ __('จำนวนภาระงานที่ปรึกษาวิทยานิพนธ์และการค้นคว้าอิสระ') }}</th>
                                    <th class="text-center text-nowrap" colspan="2">{{ __('จำนวนโควต้าคงเหลือ') }}</th>
                                    <th class="text-center align-middle text-nowrap" rowspan="2" style="width: 1%">{{ __('Actions') }}</th>
                                </tr>
                                <tr>
                                    <th class="text-center text-nowrap" style="width: 10%">{{ __('วิทยานิพนธ์ (Thesis)') }}</th>
                                    <th class="text-center text-nowrap" style="width: 10%">{{ __('การค้นคว้าอิสระ (IS)') }}</th>
                                    <th class="text-center text-nowrap" style="width: 10%;">{{ __('วิทยานิพนธ์ (Thesis)') }}</th>
                                    <th class="text-center text-nowrap" style="width: 10%;">{{ __('การค้นคว้าอิสระ (IS)') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($advisors) > 0)
                                    @foreach ($advisors as $key => $advisor)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td class="text-nowrap">
                                                {{ (!isset($advisor->academic['academic']) ? '' : $advisor->academic['academic'] . ' ') . (!isset($advisor->qualification['abbreviation']) ? '' : $advisor->qualification['abbreviation'] . ' ') . $advisor->adv_fname . ' ' . $advisor->adv_lname }}
                                            </td>

                                            @php
                                                $thesiscount = 0;
                                                $iscount = 0;
                                            @endphp

                                            @foreach ($advisor->projects as $project)

                                                @if ($project['project'] == 1 && $project['project_status'] == 0)
                                                    @php $thesiscount++; @endphp
                                                @endif

                                                @if ($project['project'] == 2 && $project['project_status'] == 0)
                                                    @php $iscount++; @endphp
                                                @endif

                                            @endforeach
                                            <td class="text-center">
                                                {{ $thesiscount > 0 ? $thesiscount : '' }}
                                            </td>
                                            <td class="text-center">
                                                {{ $iscount > 0 ? $iscount : '' }}
                                            </td>
                                            <td class="text-success text-center" style="background-color: #f8f9fa">
                                                {{-- @if ($iscount > 0) --}}
                                                @if (isset($advisor->academic['thesis']))
                                                    {{ (($advisor->academic['thesis']  - ceil($iscount/3)) - $thesiscount) == 0 ? "Full" : ($advisor->academic['thesis']  - ceil(($iscount)/3))- $thesiscount }}
                                                    @php
                                                        $quota_thesis = ($advisor->academic['thesis']  - ceil(($iscount)/3))- $thesiscount;
                                                        // echo $quota_thesis;
                                                    @endphp
                                                    {{-- {{ ($advisor->qualification['thesis'] - floor($iscount/3)) - $thesiscount }} --}}
                                                @elseif (!isset($advisor->academic['thesis']))
                                                    {{ ($advisor->qualification['thesis'] - floor($iscount/3)) - $thesiscount }}
                                                    @php
                                                        $quota_thesis = ($advisor->qualification['thesis'] - floor($iscount/3)) - $thesiscount;
                                                        // echo $quota_thesis;
                                                    @endphp
                                                    {{-- {{ ($advisor->qualification['thesis'] - floor($iscount/3)) - $thesiscount }} --}}
                                                {{-- @elseif (isset($advisor->academic['thesis']) && $iscount <= 0) --}}
                                                    {{-- {{ (($advisor->academic['thesis']  - floor($iscount/3)) - $thesiscount) == 0 ? "" : ($advisor->academic['thesis']  - floor(($iscount)/3))- $thesiscount }} --}}
                                                    {{-- {{ ($advisor->academic['thesis']  - floor(($iscount)/3)) - $thesiscount }} --}}
                                                    {{-- {{ $advisor->academic['thesis']  - $thesiscount <= 0 ? "" : $advisor->academic['thesis']  - $thesiscount }} --}}
                                                @endif
                                            </td>
                                            <td class="text-success text-center" style="background-color: #f8f9fa">
                                                @if (isset($advisor->academic['thesis']) && $thesiscount === 0)
                                                    {{ (15 - $iscount) <= 0 ? "" : (15 - $iscount) }}
                                                    @php
                                                        $quota_is = 15 - $iscount;
                                                        // echo $quota_is;
                                                    @endphp
                                                @elseif (isset($advisor->academic['thesis']) && $thesiscount > 0 && $iscount !== 0)
                                                    {{ (15 - $iscount - $thesiscount) <= 0 ? "Full" : (15 - $iscount - $thesiscount) }}
                                                    @php
                                                        $quota_is = (15 - $iscount) - $thesiscount;
                                                        //  echo $quota_is;
                                                    @endphp
                                                @elseif (isset($advisor->academic['thesis']) && $iscount === 0)

                                                    @php
                                                        $p = (10 - $thesiscount) * 3;
                                                        $q = $thesiscount + $p;
                                                        // echo $p . $q;
                                                        if ($q <= 15) {
                                                            if (($p - $iscount) <= 0) {
                                                                $n = 0;
                                                            } else {
                                                                $n = $p - $iscount;
                                                            }
                                                        } else {
                                                            $n = ($q + $thesiscount) - 15 - $iscount;
                                                        }

                                                        echo $n;
                                                        $quota_is = $n;

                                                    @endphp

                                                    {{-- {{ (15 - ($thesiscount * 3)) <= 0 ? "Full" : (15 - (10 - $thesiscount * 3)) }} --}}
                                                    @php
                                                        // $quota_is = (15 - ($thesiscount * 3)) <= 0 ? 0 : (15 - ($thesiscount * 3));
                                                        // echo $quota_is;
                                                    @endphp
                                                @else
                                                    {{ (15 - $iscount) - ($thesiscount * 3) <= 0 ? "Full" : (15 - $iscount) - ($thesiscount * 3) }}
                                                    @php
                                                        $quota_is = (15 - $iscount) - ($thesiscount * 3);
                                                        // echo $quota_is;
                                                    @endphp
                                                @endif
                                            </td>
                                            <td class="text-center text-nowrap">
                                                <a href="{{ route('advisors.show', [$advisor->id, 'quata_thesis' => $quota_thesis, 'quata_is' => $quota_is]) }}"
                                                    class="btn btn-sm btn-info"><i
                                                        class="bi bi-info-circle fs-sm me-1"></i>{{ __('Info') }}</a>
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
