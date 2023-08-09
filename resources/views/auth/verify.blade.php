@extends('layouts.guest')

@section('content')
    <div class="col-lg-12">
        <div class="card mb-4 mx-4">
            <div class="card-body p-4">
                <h1 class="text-decoration-underline">يرجى تأكيد كلمة المرور الخاصة بك قبل المتابعة.</h1>

                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        تم إرسال رابط تحقق جديد إلى عنوان بريدك الإلكتروني.
                    </div>
                @endif

                <p class="text-medium-emphasis">قبل المتابعة ، يرجى التحقق من بريدك الإلكتروني للحصول على رابط التحقق</p>
                <p class="text-medium-emphasis">إذا لم تستلم البريد الإلكتروني,</p>

                <form method="POST" action="{{ route('verification.resend') }}">
                    @csrf

                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-primary px-4" type="submit">إضغط هنا لطلب آخر</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
