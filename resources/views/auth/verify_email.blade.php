@extends('layouts.guest')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="msg text-center mt-5 w-50 mx-auto rounded bg-dark">
                    <h1>Welcome New Admin</h1>
                    <p>{{$msg}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection


