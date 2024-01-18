<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;

class ApiController extends Controller
{
    //

    public function football()
    {
        $date = now()->format('Y-m-d');
        $response = Http::withHeaders([
            'x-rapidapi-host' => 'v3.football.api-sports.io',
            'x-rapidapi-key' => '437f0cf28d88cba8c3cabfc9cd29eeb2',
        ])->get('https://v3.football.api-sports.io/fixtures?date=2023-09-02');

        // $response = config('jsonGames');
        $response = json_decode($response);
        return $response;
        // $response = $response->json();

        // } catch (\Throwable $e) {
        //     return $e;
        // }

        // $json = File::get('games.json');
        // $response = json_decode($json);

        return view('apis.football', compact('response'));
    }
}
