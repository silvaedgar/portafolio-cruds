<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Models\User;

use App\Http\Requests\UserRequest;

use App\Traits\UserTrait;

class DataTableServerSideController extends Controller
{
    use UserTrait;

    // Llama al Middleware que verifica si tiene los permisos de accesos
    public function __construct()
    {
        $this->middleware('user.isAuthorized:' . implode(";", config('permissions.middlewareDtss')));
    }


    public function index(Request $request)
    {
        $urlIndex = 'dataTableSS.index';
        if ($request->ajax()) {
            $users = User::select('*');
            return datatables()
                ->of($users)
                ->addColumn('actions', 'datatable-serverside.actions')
                ->addColumn('photo', 'datatable-serverside.userPhoto')
                ->rawColumns(['actions', 'photo'])
                ->make(true);
        }

        return view('datatable-serverside.index', compact('urlIndex'));
    }
    //

    public function store(UserRequest $request)
    {
        return redirect()
            ->route('dataTableSS.index')
            ->with('message', $this->saveUser($request));

        // return $this->saveUser($request);
    }

    public function edit($id)
    {
        $user = User::find($id);
        $findRecord = true;
        if ($user == null) {
            $findRecord = false;
        }
        return response()->json(['findRecord' => $findRecord, 'user' => $user], 200);
    }

    public function destroy($id)
    {
        $userOld = '';
        $user = User::find($id);
        $findRecord = true;
        if ($user == null) {
            $findRecord = false;
        } else {
            $userOld = $user->name;
            $user->delete();
        }
        return response()->json(['findRecord' => $findRecord, 'message' => "Usuario $userOld " . config('constants.messageDelete')], 200);
    }
}
