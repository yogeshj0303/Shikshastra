<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;

class WhatsappController extends Controller
{
    
    public function send(Request $request)
    {
        if ($request->type == 'otp') {
            $msg = 'Hi,
           
CONFIDENTIAL. DO NOT FORWARD THIS MESSAGE TO OTHERS

Your verification code to login is'. ' '.$request->otp.' 


 Thank you';
            
            $number = $request->phone_number;
        } 
      
        $message =$msg;
        $type = 'text';
         $response = Http::get('http://chatway.in/api/send-msg?number=91'. $number . '&username='. 'ACTTCONECT' . '&message=' .$msg. '&type=' . $type.'&token=' . 'WkNKQlNTNnpiYnBscGplbi9aYndoUT09');
        
       $jsonData = $response->json();
    }
 
}
    
