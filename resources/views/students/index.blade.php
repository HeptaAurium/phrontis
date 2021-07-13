@extends('layouts.app')
@php
$title = 'Registered Students';
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
                    {{-- <li class="breadcrumb-item"><a href="/students">Students</a></li> --}}
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ol>
            </div>

            <div class="panel panel-content col-12 p-3 py-5">
                <div class="floating-panel"><i class="fa fa-filter" aria-hidden="true"></i></div>
                <span class="filter display-4"> Filter
                    Students</span>
                    <div class="clearfix"></div>
                <form class="rounded p-2 row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="class">Class</label>
                            <select class="custom-select filter" name="darasa" id="darasa_filter">
                                <option value="all">All</option>
                                @foreach ($darasas as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="stream">Stream</label>
                            <select class="custom-select filter" name="stream" id="stream_filter">
                                <option value="all">All</option>
                                @foreach ($streams as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if (\App\Utilities\SettingsUtility::allow_both_gender())
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select class="custom-select filter" name="gender" id="gender_filter">
                                    <option value="both">Both</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>
                    @endif
                </form>
            </div>

            <div class="panel panel-content col-12 p-3 py-5">
                 <div class="floating-panel"><i class="fa fa-list-ul" aria-hidden="true"></i></div>
                <table class="table table-condensed table-bordered my-2 w-100 table-sm" id="tblStudents"
                    style="width: 100% !important">
                    <thead>
                        <tr>
                            <th>Adm No.</th>
                            <th>Student Name</th>
                            <th>Class</th>
                            <th>Stream</th>
                            <th>Parent Contact</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
@stop
@section('javascript')
    <script>
        $(document).ready(function() {
            $('select.filter').change(function(e) {
                e.preventDefault();
                // tblStudents.fnDestroy();
                tblStudents.ajax.reload();
            });

            tblStudents = $('table#tblStudents').DataTable({
                dom: "ftip",
                ajax: {
                    url: '/students',
                    data: function(d) {
                        d.class = $('#darasa_filter').val();
                        d.stream = $('#stream_filter').val();
                        d.gender = $('#gender_filter').val();
                    }
                },
                "order": [[ 2, "desc" ],[0, 'asc']],
                columns: [{
                        name: "adm_no",
                        data: "adm_no",
                    },
                    {
                        name: "full_name",
                        data: "full_name",
                    },
                    {
                        name: "class",
                        data: "class",
                    },
                    {
                        name: "stream",
                        data: "stream",
                    },
                    {
                        name: "contact",
                        data: "contact",
                    },
                    {
                        name: "action",
                        data: "action",
                    },
                ]
            });
        });
    </script>
@endsection
