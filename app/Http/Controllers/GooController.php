<?php

namespace App\Http\Controllers;
use App\Interfaces\IPlayerInterface;
use Illuminate\Http\Request;

class GooController extends Controller
{
    
    public function go_information(Request $request)
    {
        echo $request;
         //return response()->json($data);
        //return $this->playerRepository->player_personal_information($request);
    }
}
