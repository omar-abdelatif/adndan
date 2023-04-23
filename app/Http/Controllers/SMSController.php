<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Ghanem\LaravelSmsmisr\Facades\Smsmisr;

class SMSController extends Controller
{
    public function index()
    {
    }

    public function sendSms(Request $request)
    {
        Smsmisr::send($request->send, "201062760141");
    }
}
