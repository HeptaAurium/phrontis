@extends('layouts.app')
@php
$title = 'Examination Results';
@endphp
@section('title', $title)

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-title rounded col-12">
                <div class="floating-panel"><i class="fa fa-info" aria-hidden="true"></i></div>
                <h3 class="display-4">{{ $title }}</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/exams">Exams</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ol>
            </div>
            <div class="panel panel-content col-12 p-3 py-5">
                 <div class="floating-panel"><i class="fa fa-list-alt" aria-hidden="true"></i></div>
                <div class="row">
                    <div class="col-md-8 px-2">
                        <ul class="nav nav-tabs nav-stacked">
                            @php $x=1; @endphp
                            @foreach ($classes as $item)
                                <li class="nav-item">
                                    <a href="#results_tab{{ $item->id }}" class="nav-link @if ($x==1) active @endif
                                        switchResultsTabs">{{ $item->name }}</a>
                                </li>
                                @php $x++; @endphp
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <select class="form-control" name="" id="">
                                @foreach ($terms as $item)
                                    <option value="{{ $item->id }}" @if ($current_term) selected @endif>{{ $item->name . ' ' . $item->year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        @include('exams.partials.exam-results')
                    </div>
                </div>
            </div>

            <div class="panel panel-content col-12 p-3 py-5" style="min-height: 500px" id="filledListPanel">
                <div class="floating-panel"><i class="fa fa-check" aria-hidden="true"></i></div>
                <h3 class="display">Exam Results Check List</h3>

                <ul class="nav nav-tabs nav-stacked">
                    @php $x =1; @endphp
                    @foreach ($branches as $item)
                        @cannot('can_all')
                            @if ($item->id != auth()->user()->branch_id)
                                @php continue; @endphp
                            @endif
                        @endcannot
                        <li class="nav-item">
                            <a href="#exam_tab{{ $item->id }}" id="switch_exam_tab{{ $item->id }}"
                                class="nav-link @if ($x==1) active @endif
                                switchExamTabs">{{ $item->name }}</a>
                        </li>
                        @php $x +=1; @endphp
                    @endforeach
                </ul>
                @include('exams.partials.exam-filled-tabs')
            </div>
        </div>
    </div>
@stop
@section('javascript')
    <script src="{{ asset('js/results.js') }}"></script>
    <script src="{{ asset('js/exams.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('table.tblResults').dataTable({
                dom: "tip",
                sorting: true,
                ordering: true,
            });
        });
    </script>
@endsection
