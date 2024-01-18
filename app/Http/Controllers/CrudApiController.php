<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CrudApiController extends Controller
{

    public function __construct()
    {
        $this->middleware('user.isAuthorized:' . implode(";", config('permissions.middlewareApi')));
    }

    public function index()
    {
        return view('crud-api.index');
    }

    //
}
