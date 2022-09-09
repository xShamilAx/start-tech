@extends('layouts.login')

@section('content')

    <div class="login-box-body">
        <h2 class=""><strong><span class="text-primary">MWE Login</span></strong></h2>

        <p ><strong>Sign in to start your session</strong></p>

            <x-slot name="logo">
            </x-slot>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
                <div>
                    <div class="form-group has-feedback">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>   </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href=" {{ __('login') }}">
                            {{ __('Login') }}
                        </a>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-outline-primary">
                    {{ __('Email Password Reset Link') }}
                </button>
            </form>
    </div>


@endsection

