<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client as TwilioClient;
use Vonage\Client;
use Vonage\Client\Credentials\Basic;
use Vonage\SMS\Message\SMS;

class SMSController extends Controller
{
    public function sendSMS()
    {
        $basic = new Basic('f9bb4c90', 'D5Wa6yrJ48gx3JTz');
        $client = new Client($basic);

        $msg = new SMS("381691550212", "TOP EXPRESS 2022 d.o.o.", "Pozz");

        $response = $client->sms()->send($msg);
        
        $message = $response->current();
        
        if ($message->getStatus() == 0) {
            echo "The message was sent successfully\n";
        } else {
            echo "The message failed with status: " . $message->getStatus() . "\n";
        }
    }

    public function sendSMSTwilio()
    {
        // Find your Account SID and Auth Token at twilio.com/console
        // and set the environment variables. See http://twil.io/secure
        $sid = "ACe5a85847b0ba0b4797c88d3bc9934c52";
        $token = "ba84b0223ba02f605f4703c0f31470f3";
        $twilio = new TwilioClient($sid, $token);

        $message = $twilio->messages
                        ->create("+381691550212", // to
                                ["body" => "Pozz", "from" => "+15056665191"]
                        );

        print($message->sid);
    }

    public function sendSMSTwilioService()
    {
        $sid    = "ACe5a85847b0ba0b4797c88d3bc9934c52";
        $token  = "ba84b0223ba02f605f4703c0f31470f3";
        $twilio = new TwilioClient($sid, $token);

        $validation_request = $twilio->validationRequests
            ->create("+38169696755", // phoneNumber
                ["friendlyName" => "+38169696755"]
            );
    
        // $message = $twilio->messages
        //     ->create("+381638701074", [
        //         "messagingServiceSid" => "MGb99cc319f48ad9234ba2d68db24ab5ce", 
        //         "body" => 'Posalto iz koda'
        //     ]
        // );
    
        // print($message->sid);
    }
}
