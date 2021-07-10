@php
$r = 1;
@endphp
@foreach ($classes as $item)
    <div class="results_tab @if ($r==1) active @endif w-100"
        id="results_tab{{ $item->id }}">
        @can('can_all')
            @php
                $students = \App\Models\Student::where('class', $item->id)
                    ->orderBy('adm_no', 'DESC')
                    ->get();
            @endphp
        @else
            @php
                $students = \App\Models\Student::where('class', $item->id)
                    ->where('branch', auth()->user()->branch_id)
                    ->orderBy('adm_no', 'DESC')
                    ->get();
            @endphp
        @endcan
        @if (count($students)==0)
            <table class="table w-100 text-center table-bordered">
                <tr>
                    <td colspan="4">No data found!</td>
                </tr>
            </table>
        @else
            <table class="table table-condensed table-responsive w-100 d-block d-md-table tblResults" >
                <thead>
                    <tr class="text-center">
                        <th><i class="fa fa-hand-pointer-o" aria-hidden="true"></i></th>
                        @if (\App\Utilities\SettingsUtility::classes_have_streams())
                            <th ><small class="font-weight-bold">Stream</small></th>
                        @endif
                        <th ><small class="font-weight-bold">Adm</small></th>
                        <th class="px-4"><small class="font-weight-bold">Student</small></th>
                        @foreach ($subjects as $sub)
                            <th ><small class="font-weight-bold">{{ $sub->code }}</small></th>
                        @endforeach
                        <th > <small class="font-weight-bold">M. Score</small></th>
                        <th ><small class="font-weight-bold">M. Grade</small></th>
                        <th ><small class="font-weight-bold">Posn</small></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $stu)
                        <tr class="align-items-center">
                            <td><a href="/examination/results/{{ $stu->id }}" class="btn btn-sm btn-primary"><i
                                        class="fa fa-eye" aria-hidden="true"></i></a></td>
                            @if (\App\Utilities\SettingsUtility::classes_have_streams())
                                <td>
                                    <small>
                                        {{ \App\Models\Stream::where('id', $stu->stream)->pluck('name')->first() }}</small>
                                </td>
                            @endif
                            <td><small>{{ $stu->adm_no }}</small></td>
                            <td>
                                <small>
                                    {{ ucfirst(strtolower($stu->fname)) . ' ' . ucfirst(strtolower($stu->lname)) }}
                                </small>
                            </td>
                            @foreach ($subjects as $sub)
                                @php
                                    $mark = \App\Utilities\ExamUtil::get_student_mark_list($stu->id, $current_term['id'], $sub->id);
                                @endphp
                                <td style="min-width: 20px; text-align:center;">
                                    <small>
                                        {{ number_format($mark, 2) }}
                                        | {{ \App\Utilities\ExamUtil::grading_system($mark) }}
                                    </small>
                                </td>
                            @endforeach
                            <td class="text-center">
                                @php
                                    $mean = \App\Utilities\ExamUtil::compute_students_mean_score($stu->id);
                                @endphp
                                <small>{{ number_format($mean, 2) }} </small>
                            </td>
                            <td class="text-center">
                                @php
                                    $points = \App\Utilities\ExamUtil::convert_to_points($mean, $stu->id);
                                @endphp
                                <small>{{ number_format($points, 2) }} |
                                    {{ \App\Utilities\ExamUtil::grading_system_points($points, $stu->id) }}
                                </small>
                            </td>
                            <td class="text-center">
                                @php
                                    $posn = \App\Utilities\ExamUtil::get_student_position($mean, $item->id);
                                @endphp
                                <small>
                                    {{ number_format($posn) }}
                                </small>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    @php $r+=1; @endphp
@endforeach
