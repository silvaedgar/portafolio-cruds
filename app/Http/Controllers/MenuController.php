<?php

namespace App\Http\Controllers;

use App\Facades\VerifyPermissionsFacade;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    function portfolio()
    {
        // return VerifyPermissionsFacade::test();
        $info['activePage'] = 'inicio';
        $info['collapse'] = ''; // no va haber collapso

        return view('dashboard', compact('info'));
    }
}
