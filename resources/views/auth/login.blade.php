@extends('layouts.login')

@section('content')

    <div class="login-box-body">
        <h2 class=""><strong><span class="text-primary">Start Tech Test Login</span></strong></h2>

        <p ><strong>Sign in to start your session</strong></p>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group has-feedback">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus placeholder="Email">
                <input id="phone_no" type="text" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" value="{{ old('phone_no') }}"  autocomplete="phone_no" autofocus placeholder="Phone No">

                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @error('email')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>

            <div class="form-group has-feedback">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
            <div class="form-group has-feedback">
                <div class="checkbox icheck">
                    <label>
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    </label>
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-outline-primary">
                {{ __('Login') }}
            </button>




        </form>
    </div>


@endsection
