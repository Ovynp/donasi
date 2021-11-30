<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SmsController extends Controller
{
    public function sendSms(Request $request){
        // dd($request->all());
        Nexmo::message()->send([
            'to'   => $request->mobile,
            'from' => '0000',
            'text' => 'Terimakasih sudah berdonasi.'
        ]);

        return redirect(to.'/')->with('success','SMS Send Successfully');
    }
}
