@extends('layouts.guest')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-4 mx-4">
                    <h1 class="card-header text-decoration-underline">{{ __('Reset Password') }}</h1>
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="row mb-3 justify-content-center">
                                <div class="input-group mb-4 justify-content-center">
                                    <span class="input-group-text">
                                        <svg class="icon">
                                            <use xlink:href="{{ asset('icons/coreui.svg#cil-envelope-open') }}"></use>
                                        </svg>
                                    </span>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3 justify-content-center">
                                <div class="input-group mb-4 justify-content-center">
                                    <span class="input-group-text">
                                        <svg class="icon">
                                            <use xlink:href="{{ asset('icons/coreui.svg#cil-lock-locked') }}"></use>
                                        </svg>
                                    </span>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="New Password" name="password" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="input-group mb-4 justify-content-center">
                                    <span class="input-group-text">
                                        <svg class="icon">
                                            <use xlink:href="{{ asset('icons/coreui.svg#cil-lock-locked') }}"></use>
                                        </svg>
                                    </span>
                                    <input id="password-confirm" type="password" class="form-control" placeholder="Confirm New Password" name="password_confirmation" required autocomplete="new-password">
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <button class="btn btn-block btn-success" type="submit">{{ __('Reset Password') }}</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
