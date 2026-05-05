<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\DemoEmail; // Убедитесь, что этот класс у вас создан
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send()
    {
        $objDemo = new \stdClass();
        $objDemo->demo_one = 'Demo One Value';
        $objDemo->demo_two = 'Demo Two Value';
        $objDemo->sender = 'Maksut Amanzhol';
        $objDemo->receiver = 'Maksut Amanzhol';

        Mail::to("relaxzet1245@gmail.com")->send(new DemoEmail($objDemo));

        return "Письмо успешно отправлено!";
    }
}