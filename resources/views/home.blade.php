@extends('layouts.app')
@section('title', 'Dashboard ')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        {{-- floats --}}
        @include('home.floats')

        {{-- Charts --}}
        @include('home.charts')
    </div>
</div>
@endsection
