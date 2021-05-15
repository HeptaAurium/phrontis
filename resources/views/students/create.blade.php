@extends('layouts.app')
@php
$title = 'Add New Student';
@endphp
@section('title', $title)

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-title rounded col-12">
                <h3 class="display-4">{{ $title }}</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/students">Students</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ol>
            </div>

            <div class="panel panel-content col-12">
                <form action="/students" method="post" enctype="multipart/form-data" class="rounded p-2 ">
                    @csrf
                    <fieldset class="shadow-sm border p-3 my-2 rounded">
                        <legend>Student Information</legend>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="">Student's Full Name <span class="required text-danger">*</span> </label>
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

                            <div class="form-group col-md-4">
                                <label for="dob">Date of Birth <span class="required text-danger">*</span> </label>
                                <input type="date" name="dob" id="student_dob" class="form-control"
                                    placeholder="Date of Birth" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="gender">Legal Gender <span class="required text-danger">*</span> </label>
                                <select class="custom-select" name="gender" id="student_gender">
                                    <option value="male" selected>Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="shadow-sm p-3 border rounded my-2">
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
                            <div class="form-group col-md-4 mb-2">
                                <label for="parent_phone">Phone Number <span class="required text-danger">*</span>
                                </label>
                                <input type="tel" name="parent_phone" id="parent_phone" class="form-control"
                                    placeholder="Phone Number" required>
                            </div>
                            <div class="form-group col-md-4 mb-2">
                                <label for="parent_phone_alt">Alternate Phone Number </label>
                                <input type="tel" name="parent_phone_alt" id="parent_phone_alt" class="form-control"
                                    placeholder="Alternate Phone Number">
                            </div>
                            <div class="form-group col-md-4 mb-2">
                                <label for="parent_email">Email Address <span class="required text-danger">*</span>
                                </label>
                                <input type="tel" name="parent_email" id="parent_email" class="form-control"
                                    placeholder="Email Address" required>
                            </div>
                            <div class="form-group col-md-4 mb-2">
                                <label for="county">County of Residence <span class="required text-danger">*</span></label>
                                <select class="custom-select" name="parent_county" id="parent_county" required>
                                    @foreach ($counties as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4 mb-2">
                                <label for="parent_town">Town of Residence <span class="required text-danger">*</span>
                                </label>
                                <input type="text" name="parent_town" id="parent_town" class="form-control"
                                    placeholder="Town of Residence" required>
                            </div>
                            <div class="form-group col-md-4 mb-2">
                                <label for="parent_address">Residencial Address</label>
                                <input type="text" name="parent_address" id="parent_address" class="form-control"
                                    placeholder="Residencial Address">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="shadow-sm p-3 border rounded my-2">
                        <legend>Additional Information</legend>
                        <div class="row">
                            <div class="form-group col-md-4 mb-2">
                                <label for="class" class="d-flex flex-row align-items-center">Class <span
                                        class="float-right ml-auto"> <button class="btn bg-transparent btn-lg" type="button"
                                            data-toggle="modal" data-target="#createClassModal"><i class="fa fa-plus-square text-success"
                                                aria-hidden="true"></i> <small>Add class</small> </button> </span> </label>
                                <select class="custom-select" name="class" id="">
                                    @foreach ($classes as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            @if (\App\Utilities\SettingsUtility::classes_have_streams())
                                <div class="form-group col-md-4 mb-2">
                                  <label for="stream" class="d-flex flex-row align-items-center">Stream <span
                                        class="float-right ml-auto"> <button class="btn bg-transparent btn-lg" type="button"
                                            data-toggle="modal" data-target="#createStreamModal"><i class="fa fa-plus-square text-success"
                                                aria-hidden="true"></i> <small>Add Stream</small> </button> </span> </label>
                                    <select class="custom-select" name="stream" id="">
                                        @foreach ($streams as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            
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
