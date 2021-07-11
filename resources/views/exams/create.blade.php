@extends('layouts.app')
@php
$title = 'Record Examination Results';
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
                    <li class="breadcrumb-item"><a href="/examination/results">Exams</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ol>
            </div>

            <div class="panel panel-content col-12 p-3 py-5" style="min-height: 500px" id="examListPanel">
                <div class="floating-panel"><i class="fas fa-hand-pointer    "></i></div>
                <form action="" class="row">
                    <div class="col-md-6 p-1">
                        <div class="h-100 rounded p-4">
                            <div class="form-group">
                                <label for="class">Class</label>
                                <select class="custom-select" name="class" id="exam_class">
                                    <option value="all">Select one</option>
                                    @foreach ($classes as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <select class="custom-select" name="subject" id="exam_subject">
                                    <option value="all">Select one</option>
                                    @foreach ($subjects as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            @can('can_all')
                                <div class="form-group">
                                    <label for="branch">Branch</label>
                                    <select class="custom-select" name="branch" id="exam_branch">
                                        <option value="all">Select one</option>
                                        @foreach ($branches as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @else
                                <input type="hidden" name="" id="exam_branch" value="{{ auth()->user()->branch_id }}">
                            @endcan
                        </div>
                    </div>

                    <div class="col-md-6 p-2">
                        <div class="rounded p-3 h-100">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <h4>Exam Types</h4>
                                    <div class="row px-5">
                                        @foreach ($exam_types as $item)
                                            <div class="form-check form-switch col-6 my-2">
                                                <input class="form-check-input check-type" type="checkbox"
                                                    id="flexSwitchCheckChecked{{ $item->id }}" name="exam_types"
                                                    value="{{ $item->id }}">
                                                <label class="form-check-label"
                                                    for="flexSwitchCheckChecked{{ $item->id }}">{{ $item->name }}</label>
                                            </div>
                                            <br>
                                        @endforeach
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="my-3 flex-center col-md-8 mx-auto mt-5">
                        <button type="button" id="recordExams" class="btn btn-primary btn-lg btn-block">Proceed</button>
                    </div>
                </form>
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
                            <a href="#exam_tab{{ $item->id }}" id="switch_exam_tab{{ $item->id }}" class="nav-link @if ($x==1) active @endif switchExamTabs">{{ $item->name }}</a>
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
    <script src="{{ asset('js/exams.js') }}"></script>
@endsection
