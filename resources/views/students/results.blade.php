@extends('layouts.app')
@php
$title = 'Examination Results -  ' . ucfirst(strtolower($student->fname)) . ' ' . ucfirst(strtolower($student->lname));
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
                <div class="row">
                </div>
            </div>
        </div>
    </div>
@endsection
