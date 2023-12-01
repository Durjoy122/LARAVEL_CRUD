<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface IPlayerInterface
{
    public function player_personal_information($request);
    public function player_personal_information_delete($id);
}