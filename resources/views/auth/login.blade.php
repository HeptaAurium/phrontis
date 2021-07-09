@extends('layouts.guest')
@section('title', 'Login ')
@section('content')
    <div class="container w-100">
        <div class="app">
            <div class="bg"></div>
            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf
                <header>
                    <img src="{{ asset(\App\Utilities\SettingsUtility::get_logo_path()) }}">
                </header>

                <div class="inputs">

                    <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email" autofocus
                        placeholder="username or email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password"
                        required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    {{-- <input type="text" name="" placeholder="username or email"> --}}
                    {{-- <input type="password" name="" placeholder="password"> --}}

                    <p class="light"><a href="#">Forgot password?</a></p>
                </div>

            </form>

            <footer>
                <button id="btnLogin">Continue</button>
                {{-- <p>Don't have an account? <a href="#">Sign Up</a></p> --}}
            </footer>

        </div>
    </div>
@stop
@section('javascript')
    <script>
        $(document).ready(function() {
            $('button#btnLogin').click(function(e) {
                e.preventDefault();
                $('#loginForm').submit();
            });
        });
    </script>
@endsection
