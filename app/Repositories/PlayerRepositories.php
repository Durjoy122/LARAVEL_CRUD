<?php

namespace App\Repositories;

use App\Interfaces\IPlayerInterface;
use App\Traits\RespondsWithHttpStatus;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Models\Documents;
use App\Models\PlayerInfromation;
use File;    

class PlayerRepositories implements IPlayerInterface
{
    use RespondsWithHttpStatus;

    public function player_personal_information($request)
    {
        try {
            $attribute = [
                'first_name' => 'required', 
                'last_name' => 'required', 
                'phone' => 'required', 
                'address' => 'required', 
                'email' => 'required', 
                'gender' => 'required',
            ];

            $validator = Validator::make($request->all(), $attribute);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.',  $validator->errors());
            }

            $model = PlayerInfromation::updateOrCreate(['id' => $request->id],$request->all());

            if(!isset($model->id)) {
                throw new Exception("Error Occured on update");
            }
            
            return $this->sendResponse($model, "Player Information Successfully Added");

        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage());
        }
    }

    public function player_personal_information_delete($id)
    {
        PlayerInfromation::destroy($id);
        return $this->sendResponse([], "Player Information Successfully deleted");
    }
    
}