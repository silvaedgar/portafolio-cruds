<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

use App\Http\Requests\UserRequest;

use App\Traits\UserTrait;

use Illuminate\Pagination\Paginator;

class CrudPaginateController extends Controller
{
    use UserTrait;

    // Llama al Middleware que verifica si tiene los permisos de accesos
    public function __construct()
    {
        $this->middleware('user.isAuthorized:' . implode(";", config('permissions.middlewarePaginate')));
    }

    public function index(Request $request)
    {
        $recordToShow = 6;
        $search = '';
        $filter = [];
        $urlIndex = 'paginate.index';
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
        }
        return view('crud-paginate.index', compact('users', 'recordToShow', 'search', 'urlIndex'));
    }


    // public function recordNumber(Request $request)
    // {
    //     $users = User::paginate(30);
    //     // $routes = {
    //     //     'store' => 'dataTable.store',
    //     //     'index' => 'dataTable.index'
    //     // };

    //     return view('crud-paginate.index', compact('users'));
    // }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
