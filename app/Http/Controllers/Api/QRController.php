<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRController extends Controller
{
    public function QR($text)
    {
        // $resp['status'] = 'Ok';
        // $resp['text'] = $text;
        // return QrCode::generate($text);
        // return response()->json(['text' => $text], 200);
        // return $text;
        // return public_path();
        QrCode::generate($text, public_path() . '\qr\qr.svg');
        return response()->json(
            [
                'success' => true,
            ],
            200,
        );
    }

    public function store($name, $email)
    {
        return response()->json(
            [
                // 'response' => $request->all(),
                'name' => $name,
                'email' => $email,
            ],
            200,
        );
    }
}