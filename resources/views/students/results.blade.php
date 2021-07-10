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
                 <div class="floating-panel"><i class="fa fa-user" aria-hidden="true"></i></div>
                <div class="row">
                    <div class="col-md-4 my-2 flex-center">
                        <div class="row flex-column text-center">
                            @if (empty($student->profile))
                                <div class="col-12 flex-center">
                                    <img src="{{ asset('img/defaults/default.png') }}"
                                        class="img-fluid w-auto rounded-circle" alt="" style="height: 120px">
                                </div>
                            @else
                                <div class="col-12 flex-center">
                                    <img src="{{ asset($student->profile) }}" class="img-fluid rounded-circle" alt="">
                                </div>
                            @endif

                            <h3 class="profile-name my-4">{{ $student->fname . ' ' . $student->lname }}</h3>
                            <h4 class="profile-sub my-3">
                                {{ \App\Models\FormClass::where('id', $student->class)->pluck('name')->first() }}
                                @if ($general_settings->classes_have_streams == 1)
                                    {{ \App\Models\Stream::where('id', $student->stream)->pluck('name')->first() }}
                                @endif
                            </h4>
                            <h4 class="profile-sub my-3">
                                Subjects: {{ $student->subjects_taking }}
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-8 my-2">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    @foreach ($exam_types as $item)
                                        <th>{{ $item->name }}</th>
                                    @endforeach
                                    <th>Total <small>%</small></th>
                                    <th>Grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $session = \App\Utilities\ExamUtil::get_current_term();
                                @endphp
                                @foreach ($subjects as $sub)
                                    <tr>
                                        <td>{{ $sub->name }}</td>
                                        @foreach ($exam_types as $type)
                                            <td class="text-center">
                                                {{ \App\Utilities\ExamUtil::get_individual_marklist($student->id, $sub->id, $session['id'], $type->id) }}
                                            </td>
                                        @endforeach
                                        <td>
                                            @php
                                                $total = \App\Utilities\ExamUtil::get_student_mark_list($student->id, $session['id'], $sub->id);
                                            @endphp
                                            {{ number_format($total, 2) }}
                                        </td>
                                        <td>
                                            {{ \App\Utilities\ExamUtil::grading_system($total) }}
                                        </td>
                                    <tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- <hr class="hr-default"> --}}
                        <div class="mean-score mt-3">
                            <table class="table table-condensed">
                                <tbody>
                                    <tr class="border-bottom">
                                        <th>Total Marks <small>out of {{ $student->subjects_taking * 100 }}</small></th>
                                        <th class="text-right pr-3">
                                            @php
                                                $mean = 0;
                                                foreach ($subjects as $sub) {
                                                    $total = \App\Utilities\ExamUtil::get_student_mark_list($student->id, $session['id'], $sub->id);
                                                    $mean += $total;
                                                }
                                            @endphp
                                            {{ number_format($mean, 2) }}
                                        </th>
                                    </tr>
                                    <tr class="border-bottom">
                                        <th>Total Points <small>out of {{ $student->subjects_taking * 12 }}</small></th>
                                        <th class="text-right pr-3">
                                            @php
                                                $points = \App\Utilities\ExamUtil::convert_to_points($mean, $student->id);
                                            @endphp
                                            {{ number_format($points, 2) }}
                                        </th>
                                    </tr>
                                    <tr class="border-bottom">
                                        <th>Mean Grade </th>
                                        <th class="text-right pr-3">
                                            {{\App\Utilities\ExamUtil::grading_system_points($points, $student->id)}}
                                        </th>
                                    </tr>
                                    <tr class="border-bottom">
                                        <th>Position in Class </th>
                                         <th class="text-right pr-3">
                                            {{\App\Utilities\ExamUtil::get_student_position($mean, $student->class)}}
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr class="hr-default">
                    <div class="mt-3 col-12 students-results-buttons">
                        <div class="flex-center flex-row">
                            <a href="" class="btn btn-danger"> <i class="fas fa-file-pdf    "></i> Export PDF</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
