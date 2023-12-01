<?php
namespace App\Http\Controllers;
use App\Interfaces\IPlayerInterface;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    private IPlayerInterface $playerRepository;

    public function __construct(IPlayerInterface $playerRepository) 
    {
        $this->playerRepository = $playerRepository;
    }
    public function  player_personal_information(Request $request)
    {
        return $this->playerRepository->player_personal_information($request);
    }
    public function player_infromation_update(Request $request) 
    {
       // return $this->playerRepository->player_infromation_update($request);
    }

    public function player_personal_information_delete($id)
    {
       // echo $id;exit;
       return $this->playerRepository->player_personal_information_delete($id);
    }
} 
