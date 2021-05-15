@extends('layouts.app')

@section('title', 'Registered Classes ')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-title rounded col-12">
                <h3 class="display-4">Classes</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                    <li class="breadcrumb-item active">Registered Classes</li>
                </ol>
            </div>

            <div class="panel panel-content col-12">
                <table class="table table-condensed table-striped table-md">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Class</th>
                            <th>Subjects</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($madarasa) == 0 || empty($madarasa))
                            <td colspan="3" class="text-center"> No data found! </td>
                        @endif
                      @foreach ($madarasa as $item)
                          
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
