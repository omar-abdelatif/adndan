@extends('layouts.app')
@section('content')
    <div class="form w-100 p-3 rounded mt-4 text-center" style="background-color: #3c4b64">
        <div class="form-title my-3">
            <h3 class="text-decoration-underline text-white">إضافة حالة</h3>
        </div>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                    <p class="mb-0">{{$error}}</p>
                </div>
            @endforeach
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                <p class="mb-0">{{session('success')}}</p>
            </div>
        @endif
        <form action="{{'storecase'}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="field">
                            <input type="text" name="fullname" placeholder="إسم الحالة"
                                class="form-control mb-3 text-center">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="field">
                            <input type="number" name="ssn" placeholder="الرقم القومي"
                                class="form-control mb-3 text-center">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="field">
                            <input type="number" name="phone_number" placeholder="رقم المحمول" class="form-control mb-3 text-center">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="field">
                            <input type="number" name="age" placeholder="سن الحالة" class="form-control mb-3 text-center">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="field">
                            <input type="text" name="address" placeholder="العنوان" class="form-control mb-3 text-center">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="field">
                            <select name="income_type" class="form-control mb-3">
                                <option class="text-center" selected >إختار نوع الدخل</option>
                                <option value="retire">معاش</option>
                                <option value="without">بدون</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="field">
                            <input type="text" name="monthly_income" class="form-control mb-3 text-center" placeholder="الدخل الشهري">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="field">
                            <select name="benefit_type" class="form-control mb-2">
                                <option class="text-center" selected>إختار نوع الإستفادة للحالة</option>
                                <option value="food">عينية</option>
                                <option value="money">نقدية</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="field">
                            <select name="marital_status" class="form-control mb-2">
                                <option class="text-center" selected>إختار الحالة الاجتماعية للحالة</option>
                                <option value="single">أعزب</option>
                                <option value="married">متزوج/ة</option>
                                <option value="widow">أرمل/ة</option>
                                <option value="divorced">مطلق/ة</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="field">
                            <input type="text" name="health_status" class="form-control mb-3 text-center"placeholder="الحالة الصحية">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="field">
                            <input type="number" name="sons" class="form-control text-center mb-3" placeholder="عدد الأولاد">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="field">
                            <input type="number" name="daughters" class="form-control text-center mb-3" placeholder="عدد البنات">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="field">
                            <input type="text" name="gov" class="form-control mb-3 text-center" placeholder="المحافظة">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="field">
                            <input type="file" name="files" class="form-control mb-3 text-center" accept="image/*">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="field">
                            <input type="submit" value="إضافة" class="btn btn-success w-100">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
