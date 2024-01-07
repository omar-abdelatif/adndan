@extends('layouts.guest')

@section('content')
    <div class="col-lg-8">
        <div class="logo text-center mb-3">
            <img src="{{ asset('icons/download.png') }}" alt="logo" class="img-fluid" style="width: 130px;">
        </div>
        <div class="card-group d-block d-md-flex row">
            <div class="card col-md-7 p-4 mb-0">
                <div class="card-body">
                    <h1>تسجيل دخول</h1>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <svg class="icon">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-envelope-open') }}"></use>
                                </svg>
                            </span>
                            <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" placeholder="البريد الإلكتروني" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="input-group mb-4">
                            <span class="input-group-text">
                                <svg class="icon">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-lock-locked') }}"></use>
                                </svg>
                            </span>
                            <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="كلمة السر" required>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">
                                                تذكرني
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        @if (Route::has('password.request'))
                                            <div class="text-end">
                                                <a href="{{ route('password.request') }}" class="btn btn-link px-0 py-0" type="button">نسيت كلمة السر</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button class="btn btn-primary px-4 w-100" type="submit">تسجيل دخول</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            {{-- <div class="card col-md-5 text-white bg-primary py-5">
                <div class="card-body text-center">
                    <div>
                        <h2>تسجيل مستخدم جديد</h2>
                        <a href="{{ route('register') }}" class="btn btn-lg btn-outline-light mt-3">تسجيل مستخدم جديد</a>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
