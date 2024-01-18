<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Http\Requests\UserRequest;

use App\Traits\UserTrait;

class UserController extends Controller
{
    use UserTrait;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::select('*');
            return datatables()
                ->of($users)
                ->addColumn('actions', 'actions')
                ->addColumn('photo', 'userPhoto')
                ->rawColumns(['actions', 'photo'])
                ->make(true);
        }
        return view('crud');
    }
    //

    public function store(UserRequest $request)
    {
        return $this->saveUser($request);
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

    public function viewLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // si hay usuario logueado cierra la sesion
        if (auth()->check()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
        if (Auth::attempt(['email' => $request->name, 'password' => $request->password]) || Auth::attempt(['name' => $request->name, 'password' => $request->password])) {
            return redirect('/');
        }

        return redirect()
            ->route('user.login')
            ->with('message', 'Datos de email y/o password invalidos');
    }

    public function logout(Request $request, $redirect = True)
    {
        // return 'LOGOUT';
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
