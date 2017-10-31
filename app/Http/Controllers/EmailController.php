<?php

namespace App\Http\Controllers;

use App\Mail\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function index()
    {
        Mail::to('luis.cordero@webdiv.co')->send(new Test);
    }
}
