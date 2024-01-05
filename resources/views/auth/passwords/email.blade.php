@extends('layouts.guest')

@section('content')
    <div class="col-md-6">
        <div class="card mb-4 mx-4">
            <div class="card-body p-4">
                <h1>إعادة تعيين كلمة المرور</h1>
                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    @if(session('status'))
                        <div role="alert" class="alert alert-success py-2 ">
                            <ul class="py-0 m-0">
                                <li>{{ session('status') }}</li>
                            </ul>
                        </div>
                    @endif
                    <div class="input-group mb-3">
                        <input class="form-control text-right @error('email') is-invalid @enderror" type="email" id="email" name="email" placeholder="{{ __('Email') }}">
                        <span class="input-group-text">
                            <svg class="icon">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-envelope-open') }}"></use>
                            </svg>
                        </span>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button class="btn btn-block btn-success" type="submit">إرسال رابط إعادة تعيين كلمة السر</button>
                </form>
            </div>
        </div>
    </div>
@endsection
