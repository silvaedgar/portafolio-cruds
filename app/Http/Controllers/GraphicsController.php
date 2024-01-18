<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class GraphicsController extends Controller
{
    public function index()
    {
        $result = User::selectRaw('count(length(name)) as cant, length(name) as len')
            ->groupBy('len')
            ->get();

        $data = [];

        foreach ($result as $item) {
            $data[] = [$item->len, $item->cant];
        }

        return view('graphics.index', ['data' => json_encode($data)]);
    }
}
