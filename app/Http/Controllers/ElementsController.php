<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ElementsController extends Controller
{
    function input()
    {
        return view('elements.input');
    }

    function select()
    {
        return view('elements.select');
    }

    function check()
    {
        return view('elements.check');
    }

    function qr()
    {
        return view('qrCode.qr');
    }

    function modal()
    {
        return view('elements.modal');
    }
}
