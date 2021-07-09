@extends('layouts.app')
@php
$title = 'Add New Student';
$settings = \App\Utilities\SettingsUtility::get_all_settings();
@endphp
@section('title', $title)

@section('content')
    @include('modals.import-student')
    <div class="container">
        <div class="row">
            <div class="panel panel-title rounded col-12">
                <div class="floating-panel"><i class="fa fa-info" aria-hidden="true"></i></div>
                <h3 class="display-4">{{ $title }}</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/students">Students</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ol>
            </div>
            <div class="panel panel-content col-12">
                <div class="floating-panel"><i class="fas fa-file-import    "></i></div>
                <div class="float-right mr-3">
                    <button class="btn btn-success" data-toggle="modal" data-target="#importStudentModal"> <i class="fa fa-upload" aria-hidden="true"></i> Import CSV</button>
                </div>
            </div>

            <div class="panel panel-content col-12">
                <div class="floating-panel"><i class="fa fa-plus-square" aria-hidden="true"></i></div>
                <div class="col-12"></div>
                <form action="/students" method="post" enctype="multipart/form-data" class="rounded p-2 ">
                    @csrf
                    <fieldset class="shadow-sm border p-3 mt-4 mb-2 rounded w-100">
                        <legend>Student Information</legend>
                        <div class="row">
                            <div class="form-group col-12">
                                <label class="d-none" for="">Student's Full Name <span class="required text-danger">*</span>
                                </label>
                                <div class="row">
                                    <div class="col-md-4 mb-2">
                                        <input type="text" name="fname" id="student_fname" class="form-control"
                                            placeholder="First name" required>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <input type="text" name="mname" id="student_mname" class="form-control"
                                            placeholder="Middle name (Optional)" aria-describedby="helpId">
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <input type="text" name="lname" id="student_lname" class="form-control"
                                            placeholder="Last name" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-4 mb-4">
                                <label for="dob">Date of Birth <span class="required text-danger">*</span> </label>
                                <input type="date" name="dob" id="student_dob" class="form-control"
                                    placeholder="Date of Birth" required>
                            </div>
                            @if (\App\Utilities\SettingsUtility::allow_both_gender())
                                <div class="form-group col-md-4 mb-4">
                                    <label class="" for="gender">Legal Gender <span class="required text-danger">*</span>
                                    </label>
                                    <select class="custom-select form-control" name="gender" id="student_gender">
                                        <option value="male" selected>Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            @else
                                <input type="hidden" name="gender" value="{{ $settings->gender }}">
                            @endif
                        </div>
                    </fieldset>
                    <fieldset class="shadow-sm p-3 border rounded my-4">
                        <legend>Student's Parent/Guardian Information</legend>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="">Parent's/Guardian's Full Name <span class="required text-danger">*</span>
                                </label>
                                <div class="row">
                                    <div class="col-md-4 mb-2">
                                        <input type="text" name="parent_fname" id="parent_fname" class="form-control"
                                            placeholder="First name" required>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <input type="text" name="parent_mname" id="parent_mname" class="form-control"
                                            placeholder="Middle name (Optional)" aria-describedby="helpId">
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <input type="text" name="parent_lname" id="parent_lname" class="form-control"
                                            placeholder="Last name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4 mb-4 mb-2">
                                <label for="parent_phone">Phone Number <span class="required text-danger">*</span>
                                </label>
                                <input type="tel" name="parent_phone" id="parent_phone" class="form-control"
                                    placeholder="Phone Number" required>
                            </div>
                            <div class="form-group col-md-4 mb-4 mb-2">
                                <label for="parent_phone_alt">Alternate Phone Number </label>
                                <input type="tel" name="parent_phone_alt" id="parent_phone_alt" class="form-control"
                                    placeholder="Alternate Phone Number">
                            </div>
                            <div class="form-group col-md-4 mb-4 mb-2">
                                <label for="parent_email">Email Address <span class="required text-danger">*</span>
                                </label>
                                <input type="email" name="parent_email" id="parent_email" class="form-control"
                                    placeholder="Email Address">
                            </div>
                            <div class="form-group col-md-4 mb-4 mb-2">
                                <label for="county">County of Residence <span class="required text-danger">*</span></label>
                                <select class="custom-select form-control" name="parent_county" id="parent_county" required>
                                    <option>County of Residence</option>
                                    @foreach ($counties as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4 mb-4 mb-2">
                                <label for="parent_town">Town of Residence <span class="required text-danger">*</span>
                                </label>
                                <input type="text" name="parent_town" id="parent_town" class="form-control"
                                    placeholder="Town of Residence" required>
                            </div>
                            <div class="form-group col-md-4 mb-4 mb-2">
                                <label for="parent_address">Residencial Address</label>
                                <input type="text" name="parent_address" id="parent_address" class="form-control"
                                    placeholder="Residencial Address">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="shadow-sm p-3 border rounded my-4">
                        <legend>Additional Information</legend>
                        <div class="row">
                            @if (\App\Utilities\SettingsUtility::manual_adm_no())
                                <div class="form-group col-md-4 mb-4 mb-2">
                                    <label for="adm_no">Admission No <span class="required text-danger">*</span>
                                    </label>
                                    <input type="text" name="adm_no" id="adm_no" class="form-control"
                                        placeholder="Admission No." required>
                                </div>
                            @else
                                <input type="hidden" name="adm_no" value="automatic">
                            @endif

                            <div class="form-group col-md-4 mb-4 mb-2">
                                <label for="class" class="d-flex flex-row align-items-center">Class <span
                                        class="float-right ml-auto"> <button class="btn bg-transparent btn-lg" type="button"
                                            data-toggle="modal" data-target="#createClassModal"><i
                                                class="fa fa-plus-square text-success" aria-hidden="true"></i> <small>Add
                                                class</small> </button> </span> </label>
                                <select class="custom-select form-control" name="class" id="">
                                    @foreach ($classes as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            @if (\App\Utilities\SettingsUtility::classes_have_streams())
                                <div class="form-group col-md-4 mb-4 mb-2">
                                    <label for="stream" class="d-flex flex-row align-items-center">Stream <span
                                            class="float-right ml-auto"> <button class="btn bg-transparent btn-lg"
                                                type="button" data-toggle="modal" data-target="#createStreamModal"><i
                                                    class="fa fa-plus-square text-success" aria-hidden="true"></i>
                                                <small>Add Stream</small> </button> </span> </label>
                                    <select class="custom-select form-control" name="stream" id="">
                                        @foreach ($streams as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                        </div>
                    </fieldset>

                    <fieldset class="shadow-sm p-3 border rounded my-2 py-3">
                        <div class="row align-items-center py-3">
                            <div class="col-md-3 d-flex flex-center">
                                <button class="btn btn-sm btn-block my-2 btn-secondary"> <i class="fa fa-eraser"
                                        aria-hidden="true"></i> Clear Inputs</button>
                            </div>
                            <div class="col-md-6 d-flex flex-center">
                                <button class="btn btn-lg btn-block my-2 btn-success"> <i class="fa fa-check"
                                        aria-hidden="true"></i> Add Student</button>
                            </div>
                            <div class="col-md-3 d-flex flex-center">
                                <a href="/students" class="btn  btn-block btn-sm btn-danger"> <i class="fas fa-ban    "></i>
                                    Cancel</a>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    {{-- modals --}}
    @include('modals.create-class')
    @include('modals.create-stream')
@stop
@section('javascript')
    <script>
        $(document).ready(function() {
            $('#parent_county').select2();
        });
    </script>
@endsection
