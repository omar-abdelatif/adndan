<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class SMSController extends Controller
{
    public function index()
    {
        return view('text.sendnew');
    }
    public function sendSms(Request $request)
    {
        $client = new Client(['base_uri' => 'https://bulk.whysms.com/api/v3/sms/']);
        $content = $request->send;
        $response = $client->post('send', [
            'headers' => [
                'Authorization' => 'Bearer 154|gJbhBOnUeY219y0Md52v17zrLtRkXR2SWwl8RtXc',
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'json' => [
                'recipient' => '+201062760141,+201002154202,+201097439060,+201097433859',
                'sender_id' => 'WhySMS',
                'type' => 'plain',
                'message' => $content,
            ],
            'verify' => false, // to disable SSL certificate verification
        ]);
        return $response->getBody()->getContents();
    }
}
