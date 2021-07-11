<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $student->fname . ' ' . $student->lname }}</title>
    @include('forms.partials.css')
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
    </style>
</head>

<body class="p-3">
    <header style="background-color: #8AB4F8;color:#fff;">
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
        <table class="table w-100 text-center table-borderless table-xs mt-5">
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
        <table class="table w-100 text-center table-xs mt-4">
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

        <div class="mean-score mt-3">
            <table class="table table-condensed table-bordered my-3">
                <tbody>
                    <tr class="border-bottom">
                        <th>Total Marks <small>out of {{ $student->subjects_taking * 100 }}</small></th>
                        <th class="text-right pr-3 border-right">
                            @php
                            $mean = 0;
                            foreach ($subjects as $sub) {
                            $total = \App\Utilities\ExamUtil::get_student_mark_list($student->id, $session['id'],
                            $sub->id);
                            $mean += $total;
                            }
                            @endphp
                            {{ number_format($mean, 2) }}
                        </th>

                        <th>Total Points <small>out of {{ $student->subjects_taking * 12 }}</small></th>
                        <th class="text-right pr-3 border-right">
                            @php
                            $points = \App\Utilities\ExamUtil::convert_to_points($mean, $student->id);
                            @endphp
                            {{ number_format($points, 2) }}
                        </th>
                    </tr>
                    <tr class="border-bottom">
                        <th>Mean Grade </th>
                        <th class="text-right pr-3 border-right">
                            {{ \App\Utilities\ExamUtil::grading_system_points($points, $student->id) }}
                        </th>

                        <th>Position in Class </th>
                        <th class="text-right pr-3 border-right">
                            {{ \App\Utilities\ExamUtil::get_student_position($mean, $student->class) }}
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mean-score mt-3">
            <h3>Metrics:</h3>
            <table class="table table-condensed">
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