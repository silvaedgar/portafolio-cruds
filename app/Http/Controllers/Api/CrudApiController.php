<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\UserTrait;

class CrudApiController extends Controller
{
    use UserTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $recordToShow = 6;
        $search = '';
        $filter = [];
        if (count($request->all()) > 0) {
            if (!empty($request->search)) {
                $search = $request->search;
                $filter = [['name', 'like', '%' . $request->search . '%']];
            }
            if (isset($request->recordToShow)) {
                $recordToShow = $request->recordToShow;
            }
        }
        if ($recordToShow == 'All') {
            $users = User::where($filter)->get();
        } else {
            $users = User::where($filter)->paginate($recordToShow);
            // if ($request->page > 1)
            //     $users = $users->currentPage();
        }

        return response()->json([
            'recordToShow' => $recordToShow,
            'collection' => $users,
            'success' => true,
            'message' => "Listado de Usuarios"
        ], 200);
    }

    public function permissions()
    {
        return response()->json([
            'auth' => auth()->user()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        return response()->json([
            'success' => true,
            'message' =>  $this->saveUser($request)
        ], 200);
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        $success = $user ? true : false;
        return response()->json([
            'user' => $user,
            'success' => $success,
            'message' => $success ? 'Registro Encontrado' : 'Registro no encontrado'
        ], 200);
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $success = $user ? true : false;
        return response()->json([
            'user' => $user,
            'success' => $success,
            'message' => $this->deleteUser($id)
        ], 200);

        //
    }
}
