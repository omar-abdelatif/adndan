@extends('layouts.app')
@section('content')
    <table class="table borderd-table display align-middle text-center" id="table" data-order='[[ 1, "asc" ]]'
        data-page-length='25'>
        <thead>
            <tr>
                <td class="text-center">id</td>
                <td class="text-center">الإسم</td>
                <td class="text-center">رقم التلفون</td>
                <td class="text-center">تاريخ التسجيل</td>
                <td class="text-center">Actions</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>عمر</td>
                <td>0123456789</td>
                <td>25/02/2023</td>
                <td>
                    <a class="btn btn-danger" href=""> حذف </a>
                    <button type="button" class="btn btn-primary" data-coreui-toggle="modal" data-coreui-target="#exampleModal" data-coreui-whatever="@mdo"> عرض </button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">بيانات الحالة كاملة</h5>
                                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="inputs">
                                                        <div class="inputs-title mb-2">
                                                            <h3>البيانات الشخصية للحالة</h3>
                                                        </div>
                                                        <div class="inputs-body">
                                                            <input type="text" name="name"
                                                                class="form-control mb-2 text-center"
                                                                placeholder="إسم الحالة">
                                                            <input type="number" name="phone_number"
                                                                class="form-control mb-2 text-center"
                                                                placeholder="رقم المحمول">
                                                            <input type="number" name="age"
                                                                class="form-control mb-2 text-center" placeholder="السن">
                                                            <input type="number" name="national_number"
                                                                class="form-control mb-2 text-center"
                                                                placeholder="الرقم القومي">
                                                            <input type="text" name="address"
                                                                class="form-control mb-2 text-center" placeholder="العنوان">
                                                            <input type="text" name="gov"
                                                                class="form-control mb-2 text-center"
                                                                placeholder="المحافظة">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="inputs">
                                                        <div class="inputs-title">
                                                            <h3>البيانات المادية للحالة</h3>
                                                        </div>
                                                        <div class="inputs-body">
                                                            <input type="number" name="salary"
                                                                class="form-control mb-2 text-center"
                                                                placeholder="الدخل الشهري">
                                                            <select name="benefit" class="form-control mb-2">
                                                                <option class="text-center" selected>إختار نوع الإستفادة
                                                                    للحالة</option>
                                                                <option value="food">عينية</option>
                                                                <option value="money">نقدية</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="inputs mt-3">
                                                        <div class="inputs-title">
                                                            <h3>البيانات الإجتماعية</h3>
                                                        </div>
                                                        <div class="inputs-body">
                                                            <select name="social" class="form-control mb-2">
                                                                <option class="text-center" selected>إختار الحالة الاجتماعية
                                                                    للحالة</option>
                                                                <option value="أعزب">أعزب</option>
                                                                <option value="متزوج">متزوج/ة</option>
                                                                <option value="أرمل">أرمل/ة</option>
                                                            </select>
                                                            <input type="text" name="health"
                                                                class="form-control mb-2 text-center"
                                                                placeholder="الحالة الصحية">
                                                            <input type="text" name="insurance"
                                                                class="form-control mb-2 text-center"
                                                                placeholder="الحالة التأمينية">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="inputs mt-3">
                                                        <div class="inputs-title">
                                                            <h3>عائلة الحالة</h3>
                                                        </div>
                                                        <div class="inputs-body">
                                                            <input type="number" name="sons"
                                                                class="form-control text-center mb-2"
                                                                placeholder="عدد الأولاد">
                                                            <input type="number" name="daughters"
                                                                class="form-control text-center" placeholder="عدد البنات">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="inputs mt-3">
                                                        <div class="inputs-title">
                                                            <h3>ملفات الحالة</h3>
                                                        </div>
                                                        <div class="inputs-body">
                                                            <input type="file" name="files" class="form-control mb-3 text-center" accept="image/*">
                                                            <div class="files">
                                                                {{-- @if ()

                                                                @else
                                                                    <h1 class="text-center">لا توجد ملفات للحالة</h1>
                                                                @endif --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <input type="submit" class="btn btn-primary mt-3 d-block w-100"
                                                        height="50px" value="Submit">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
@endsection
