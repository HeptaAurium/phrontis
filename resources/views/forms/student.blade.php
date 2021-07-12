<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $student->fname . ' ' . $student->lname }}</title>
    {{-- @include('forms.partials.css') --}}
    <style>
        * {
            margin: 0;
            padding: 0;
            /* background: #fff; */
        }

        .page_break {
            page-break-before: always;
        }

        body {
            background-color: #fff;
        }

        .middle {
            margin-left: 25%;
        }

        .header {
            height: 160px;

        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody+tbody {
            border-top: 2px solid #dee2e6;
        }

        .table-sm th,
        .table-sm td {
            padding: 0.3rem;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
        }

        .p-3 {
            padding: 1rem !important;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .text-left {
            text-align: left !important;
        }

        .text-right {
            text-align: right !important;
        }

        .text-center {
            text-align: center !important;
        }

        .col-xs-1,
        .col-sm-1,
        .col-md-1,
        .col-lg-1,
        .col-xs-2,
        .col-sm-2,
        .col-md-2,
        .col-lg-2,
        .col-xs-3,
        .col-sm-3,
        .col-md-3,
        .col-lg-3,
        .col-xs-4,
        .col-sm-4,
        .col-md-4,
        .col-lg-4,
        .col-xs-5,
        .col-sm-5,
        .col-md-5,
        .col-lg-5,
        .col-xs-6,
        .col-sm-6,
        .col-md-6,
        .col-lg-6,
        .col-xs-7,
        .col-sm-7,
        .col-md-7,
        .col-lg-7,
        .col-xs-8,
        .col-sm-8,
        .col-md-8,
        .col-lg-8,
        .col-xs-9,
        .col-sm-9,
        .col-md-9,
        .col-lg-9,
        .col-xs-10,
        .col-sm-10,
        .col-md-10,
        .col-lg-10,
        .col-xs-11,
        .col-sm-11,
        .col-md-11,
        .col-lg-11,
        .col-xs-12,
        .col-sm-12,
        .col-md-12,
        .col-lg-12 {
            position: relative;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }

        .col-lg-12 {
            width: 100%;
        }

        .col-1 {
            flex: 0 0 8.3333333333%;
            max-width: 8.3333333333%;
        }

        .col-2 {
            flex: 0 0 16.6666666667%;
            max-width: 16.6666666667%;
        }

        .col-3 {
            flex: 0 0 25%;
            max-width: 25%;
        }

        .col-4 {
            flex: 0 0 33.3333333333%;
            max-width: 33.3333333333%;
        }

        .col-5 {
            flex: 0 0 41.6666666667%;
            max-width: 41.6666666667%;
        }

        .col-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }

        .col-7 {
            flex: 0 0 58.3333333333%;
            max-width: 58.3333333333%;
        }

        .col-8 {
            flex: 0 0 66.6666666667%;
            max-width: 66.6666666667%;
        }

        .col-9 {
            flex: 0 0 75%;
            max-width: 75%;
        }

        .col-10 {
            flex: 0 0 83.3333333333%;
            max-width: 83.3333333333%;
        }

        .col-11 {
            flex: 0 0 91.6666666667%;
            max-width: 91.6666666667%;
        }

        .col-12 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6 {
            margin-bottom: 0.5rem;
            font-weight: 500;
            line-height: 1.2;
        }

        h1,
        .h1 {
            font-size: 2.25rem;
        }

        h2,
        .h2 {
            font-size: 1.8rem;
        }

        h3,
        .h3 {
            font-size: 1.575rem;
        }

        h4,
        .h4 {
            font-size: 1.35rem;
        }

        h5,
        .h5 {
            font-size: 1.125rem;
        }

        h6,
        .h6 {
            font-size: 0.9rem;
        }

        .w-100 {
            width: 100% !important;
        }

        .w-auto {
            width: auto !important;
        }
        .border {
        border: 1px solid #dee2e6 !important;
        }
        
        .border-top {
        border-top: 1px solid #dee2e6 !important;
        }
        
        .border-right {
        border-right: 1px solid #dee2e6 !important;
        }
        
        .border-bottom {
        border-bottom: 1px solid #dee2e6 !important;
        }
        
        .border-left {
        border-left: 1px solid #dee2e6 !important;
        }
        
        .border-0 {
        border: 0 !important;
        }

        small {
            font-size: 80%;
        }
    </style>
</head>

<body class="p-3">
    <header style="background-color: #8AB4F8;color:#fff;padding:16px">
        <div class="row header">
            <div class="text-center col-4 logo">
                <img src="data:image/png;base64,{!! $logo !!}" alt="" style="height: 80%; width:auto"
                    class="img-responsive">
            </div>
            <div class="col-6 text-center middle">
                <h3>Alpha Schools, Thika</h3>
                <h5>Alpha Juja</h5>
                <h5>Report Form</h5>
                <p>PO BOX 4000-01002 MADARAKA, THIKA</p>
            </div>
            <div class="col-2"></div>
        </div>
    </header>
    {{-- <hr style="border:none;padding:3px; background:#fff"> --}}
    <div>
        @php
        $session = \App\Utilities\ExamUtil::get_current_term();
        @endphp
        <table class="table w-100 text-center table-borderless table-xs mt-2">
            <tbody>
                <tr>
                    <th class="text-right">Student Name:</th>
                    <th class="text-left">
                        {{ucfirst(strtolower($student->fname)) ." ". ucfirst(strtolower($student->mname." ".ucfirst(strtolower($student->lname))))}}
                    </th>
                    <th class="text-right">Admission No:</th>
                    <th class="text-left">
                        {{$student->adm_no}}
                    </th>
                    <th class="text-right">Class:</th>
                    <th class="text-left">
                        {{$class->name}}
                    </th>
                </tr>
                <tr>
                    <th class="text-right">Session:</th>
                    <th class="text-left">
                        {{$session['name']}}
                    </th>
                </tr>
            </tbody>
        </table>
        <table class="table w-100 text-center table-xs mt-2">
            <thead>
                <tr>
                    <th class="text-left pl-3">Subject</th>
                    @foreach ($exam_types as $item)
                    @php
                    if($student->class < 3) { if ($item->kind == 'full') {
                        continue;
                        }
                        }else{
                        if($item->kind == 'endTerm'){
                        continue;
                        }
                        }
                        @endphp
                        <th>{{ $item->name }}</th>
                        @endforeach
                        <th>Total <small>%</small></th>
                        <th>Grade</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($subjects as $sub)
                <tr>
                    <td class="text-left pl-3">{{ $sub->name }}</td>
                    @foreach ($exam_types as $type)
                    @php
                    if($student->class < 3){ if($type->kind == 'full') {
                        continue;
                        }
                        }else{
                        if($type->kind == 'endTerm'){
                        continue;
                        }
                        }
                        @endphp
                        <td class="text-center">
                            {{ \App\Utilities\ExamUtil::get_individual_marklist($student->id, $sub->id, $session['id'], $type->id) }}
                        </td>
                        @endforeach
                        <td>
                            @php
                            $total = \App\Utilities\ExamUtil::get_student_mark_list($student->id, $session['id'],
                            $sub->id);
                            @endphp
                            {{ number_format($total, 2) }}
                        </td>
                        <td>
                            {{ \App\Utilities\ExamUtil::grading_system($total) }}
                        </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mean-score" style="margin-top: 16px">
            <table class="table table-condensed  my-3">
                <tbody>
                    <tr class="">
                        <th>Total Marks </th>
                        <td class="text-right pr-3 border-right">
                            @php
                            $mean = 0;
                            foreach ($subjects as $sub) {
                            $total = \App\Utilities\ExamUtil::get_student_mark_list($student->id, $session['id'],
                            $sub->id);
                            $mean += $total;
                            }
                            @endphp
                            {{ number_format($mean, 2) }} <small>/{{ $student->subjects_taking * 100 }}</small>
                        </td>

                        <th>Total Points </th>
                        <td class="text-right pr-3 border-right">
                            @php
                            $points = \App\Utilities\ExamUtil::convert_to_points($mean, $student->id);
                            @endphp
                            {{ number_format($points, 2) }} <small>/{{ $student->subjects_taking * 12 }}</small>
                        </td>
                        <th>Mean Grade </th>
                        <td class="text-right pr-3 border-right">
                            {{ \App\Utilities\ExamUtil::grading_system_points($points, $student->id) }}
                        </td>

                        <th>Position in Class </th>
                        <td class="text-right pr-3 border-right">
                            {{ \App\Utilities\ExamUtil::get_student_position($mean, $student->class) }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mean-score" style="margin-top: 16px;">
            <h3>Metrics:</h3>
            <table class="table table-condensed w-100 border-0">
                <tbody>
                    <tr>
                        <td>A - Excellent</td>
                        <td>B - Above Average</td>
                        <td>C - Average</td>
                        <td>D - Below Average</td>
                        <td>E - Poor</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>