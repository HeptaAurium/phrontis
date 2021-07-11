@extends('layouts.app')
@php
$title = 'Examination Types';
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

            <div class="panel panel-content col-12 p-3 py-5">
                  <div class="floating-panel"><i class="fa fa-list-ul" aria-hidden="true"></i></div>
                <table class="table table-condensed table-bordered table-sm table-striped text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Exam Type</th>
                            <th>Out of<small>(Predefined)</small></th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($exam_types as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td class="text-left pl-5">{{$item->name}}</td>
                                <td>{{$item->out_of}}</td>
                                {{-- <td></td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
