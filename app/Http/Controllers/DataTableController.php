<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

use App\Http\Requests\UserRequest;

use App\Traits\UserTrait;

class DataTableController extends Controller
{
    use UserTrait;

    // Llama al Middleware que verifica si tiene los permisos de accesos
    public function __construct()
    {
        $this->middleware('user.isAuthorized:' . implode(";", config('permissions.middlewareDtclient')))->only('index');
    }


    public function index()
    {
        $users = User::all();
        $urlIndex = 'dataTable.index';
        return view('datatable.index', compact('users', 'urlIndex')); //
    }

    public function store(UserRequest $request)
    {
        $urlIndex = $request->urlIndex;
        return redirect()
            ->route($urlIndex)
            ->with('message', $this->saveUser($request));
    }

    public function destroy(Request $request)
    {
        return redirect()
            ->route($request->urlIndex)
            ->with('message', $this->deleteUser($request->id));
    }
}
