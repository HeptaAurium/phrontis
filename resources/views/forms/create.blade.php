@extends('layouts.app')
@php
$title = 'Report Forms';
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
        <div class="panel panel-content col-12">
            <div class="floating-panel"><i class="fa fa-list-ol" aria-hidden="true"></i></div>
            <form action="/examination/generate" method="POST" id="formGenReport" class="mt-5">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Class</label>
                            <select class="custom-select" name="class" id="report_class">
                                {{-- <option value="all">All</option> --}}
                                @foreach ($classes as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Session</label>
                            <select class="custom-select" name="session">
                                <option value="{{$session['id']}}">{{$session['name']}}</option>
                                {{-- @foreach ($classes as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach --}}
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 my-5">
                        <div class="row align-items-center justify-content-center pr-3">
                            <button class="btn btn-danger py-3" id="genReportForms"><i class="fas fa-file-pdf"></i>
                                Generate Report
                                Forms</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@section('javascript')
<script>
    $(document).ready(function () {
        $('button#genReportForms').click(function (e) { 
            e.preventDefault();
            $('.se-pre-con').removeClass('hidden').fadeIn();
            $('form#formGenReport').submit();
        });
    });
</script>
@endsection