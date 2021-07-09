@extends('layouts.app')

@section('title', 'Registered Classes ')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-title rounded col-12">
                 <div class="floating-panel"><i class="fa fa-info" aria-hidden="true"></i></div>
                <h3 class="display-4">Classes</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                    <li class="breadcrumb-item active">Registered Classes</li>
                </ol>
            </div>

            <div class="panel panel-content col-12">
                 <div class="floating-panel"><i class="fa fa-plus-square" aria-hidden="true"></i></div>
                <div class="button-panel float-right my-2">
                    <button class="btn btn-primary align-items-center px-4" type="button" data-toggle="modal"
                        data-target="#createClassModal"><i class="fa fa-plus" aria-hidden="true"></i>
                        <small>Add class</small> </button>
                </div>
                <table class="table table-condensed table-striped table-md text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Class</th>
                            <th>Streams</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($madarasa) == 0 || empty($madarasa))
                            <td colspan="3" class="text-center"> No data found! </td>
                        @endif
                        @foreach ($madarasa as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    @php
                                        $streams = explode(',', $item->streams);
                                    @endphp
                                    @foreach ($streams as $stream)
                                        <span
                                            class="badge badge-secondary px-2 py-1 mx-1">{{ \App\Utilities\StreamUtil::listStreamByName($stream) }}
                                        </span>
                                    @endforeach
                                </td>
                                <td>
                                    <div class="flex-center">
                                        <button class="btn btn-secondary btn-sm"><i class="fas fa-pencil-alt"></i>
                                            Edit</button>
                                        <button class="btn btn-primary btn-sm mx-2"><i class="fas fa-eye"></i> View</button>
                                        <form action="/classes/{{ $item->id }}" method="post"
                                            id="formDeleteClass{{ $item->id }}">
                                                                                        @csrf
                                            @method('delete')
                                            <input type="hidden" name="id" value="{{$item->id}}">
                                            <button class="btn btn-danger btn-DeleteClass btn-sm"
                                                data-target="#formDeleteClass{{ $item->id }}"><i
                                                    class="fas fa-trash"></i>
                                                Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modals --}}
    @include('modals.create-class')
@stop
@section('javascript')
    <script>
        $(document).ready(function() {
            $('.btn-DeleteClass').click(function(e) {
                e.preventDefault();
                var id = $(this).data('target');
                Swal.fire({
                    title: "Are you sure?",
                    type: "warning",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "Cancel",
                    closeOnConfirm: false,
                    closeOnCancel: false

                }).then((result) => {
                    if (result.isConfirmed) {
                        $(id).submit();
                    }
                });
            });
        });

    </script>
@endsection
