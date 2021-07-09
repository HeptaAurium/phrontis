<form action="/exams" method="post" id="marksForm">
    @csrf
    <div class="table-caption d-flex flex-row align-items-center">
        <label class="col-md-3 d-flex flex-row align-items-center">
            <h4><strong class="mr-2">School: </strong> <br><span
                    class="badge badge-primary px-5 py-1">{{ $branch->name }}</span></h3>
        </label>
        <label class="col-md-3 d-flex flex-row align-items-center">
            <h4><strong class="mr-2">Class: </strong> <br><span
                    class="badge badge-info px-5 py-1 text-white">{{ $class->name }}</span></h3>
        </label>
        <label class="col-md-3 d-flex flex-row align-items-center">
            <h4><strong class="mr-2">Subject: </strong> <br><span
                    class="badge badge-success px-5 py-1">{{ $subject->name }}</span></h3>
        </label>
        <div class="col-md-3 flex-center">
            <button id="reloadPage" class="btn btn-dark"><i class="fa fa-reply" aria-hidden="true"></i> Change</button>
            <button id="postResults" class="btn btn-success ml-2 px-4"><i class="fa fa-save" aria-hidden="true"></i>
                Save</button>
        </div>
    </div>
    <table class="table table-bordered table-sm table-responsive-md table-striped">
        <thead>
            <tr>
                {{-- <th class="text-center" style="width:5%" rowspan="2">#</th> --}}
                <th style="text-align:center" rowspan="2">Adm No</th>
                <th rowspan="2">Student name</th>
                @foreach ($exam_types as $item)
                    @php
                        $type = \App\Models\ExamType::where('id', $item)->first();
                    @endphp
                    <th class="text-center">
                        {{ $type->name }}
                    </th>
                @endforeach
            </tr>
            <tr>
                @php
                    $count = count($exam_types);
                    $perc = 80 / $count;
                @endphp
                @foreach ($exam_types as $item)
                    @php
                        $type = \App\Models\ExamType::where('id', $item)->first();
                    @endphp
                    <td class="text-center">
                        <small>out of</small>
                        <input type="text" value="{{ $type->out_of }}" class="border-0 text-center exam-input"
                            name="type{{ $item }}" id="type{{ $item }}">
                    </td>
                @endforeach
            </tr>
            <input type="hidden" name="exam_types" value="{{ json_encode($exam_types) }}">
            <input type="hidden" name="subject" value="{{ json_encode($subject->id) }}">
            <input type="hidden" name="branch" value="{{ $branch->id }}">
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td class="text-center">{{ $student->adm_no }}</td>
                    <td>{{ $student->fname . ' ' . $student->lname }}</td>
                    @foreach ($exam_types as $ex)
                        @php
                            $type = \App\Models\ExamType::where('id', $ex)->first();
                        @endphp
                        <td class="text-center">
                            @if (!empty($exams))
                                @php
                                    $marks = \App\Utilities\ExamUtil::get_marks_by_type($student->id, $class->id, $subject->id, $ex);
                                @endphp
                                <input type="text" class="border-0 exam-input results"
                                    value="{{ !empty($marks) ? $marks : '0.00' }}"
                                    data-class="{{ $student->class }}" data-student="{{ $student->id }}"
                                    data-exam_type="{{ $ex }}">
                            @else
                                <input type="text" class="border-0 exam-input edit results" value="0.00"
                                    data-class="{{ $student->class }}" data-student="{{ $student->id }}"
                                    data-exam_type="{{ $ex }}">
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</form>
