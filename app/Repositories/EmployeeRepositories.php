<?php

namespace App\Repositories;
use App\Traits\RespondsWithHttpStatus;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Models\EmployeeInfo;
use App\Models\EmployeeResult;
use App\Models\CheckTrue;
use App\Interfaces\IEmployeeInterface;
use App\Models\Documents;
use File;    

class EmployeeRepositories implements IEmployeeInterface
{
    use RespondsWithHttpStatus;

    public function employee_personal_information($request) {
        try {
            $attribute = [
                'first_name' => 'required', 
                'last_name' => 'required', 
                'phone' => 'required', 
                'email' => 'required', 
                'address' => 'required',
                'education' => 'required',
            ];

            $validator = Validator::make($request->all(), $attribute);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.',  $validator->errors());
            }

            $model = EmployeeInfo::updateOrCreate(['id' => $request->id],$request->all());

            if(!isset($model->id)) {
                throw new Exception("Error Occured on update");
            }
            
            return $this->sendResponse($model, "Player Information Successfully Added");

        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage());
        }
    }

    public function employee_delete($id) {
        EmployeeInfo::destroy($id);
        return $this->sendResponse([], "Employee Information Successfully deleted");
    }

    public function if_check_true($request) {
        try {
            $attribute = [
                'photos' => 'required|image|max:512',
            ];

            $validator = Validator::make($request->all(), $attribute);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.',  $validator->errors());
            }

            $input = $request->all();
            $profile_pic_data = $request->file('photos');

            if(!empty($profile_pic_data))
            {
                $oldPicture = CheckTrue::find($request->id)->photos;
                $extension = $profile_pic_data->getClientOriginalExtension();
                $destinationPath = public_path('profilePicture');
                $fileName = 'pic'.rand().'.'.$extension; 
                if (!$profile_pic_data->move($destinationPath, $fileName)) {
                    throw new Exception("Image Upload Error");
                }
                unlink(public_path($oldPicture));
                $input['photos'] = '/profilePicture/'.$fileName;
            }

            $model = CheckTrue::updateOrCreate(['id' => $request->id],$input);

            if(!isset($model->id)) {
                throw new Exception("Error Occured on update");
            }
            return $this->sendResponse($model, "Personal Information Updated Successfully");
        } 
        catch (Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage());
        }
    }

    public function employee_result($request) {
        try {
            $attribute = [
                'name' => 'required|min:7',
                'psc_score' => 'required', 
                'ssc_score' => 'required', 
                'hsc_score' => 'required', 
                'ba_score' => 'required',
                'ma_score' => 'required',
                'phd' => 'required',
            ];
            $validator = Validator::make($request->all(), $attribute);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.',  $validator->errors());
            }
            $model = EmployeeResult::Create($request->all());
            if(!isset($model->id)) {
                throw new Exception("Error Occured on update");
            }
            return $this->sendResponse($model, "Employee Education Successfully Added");

        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage());
        }
    }

    public function employee_result_up($request) {
        try {
            $attribute = [
                'name' => 'required|min:7',
                'psc_score' => 'required',
                'ssc_score' => 'required',
                'hsc_score' => 'required',
                'ba_score' => 'required',
                'ma_score' => 'required',
                'phd' => 'required',
            ];
    
            $validator = Validator::make($request->all(), $attribute);
            if ($validator->fails()) {
                return $this->sendError($validator->errors());
            }
            $model = EmployeeResult::find($request->id);
            if (!$model) {
                throw new Exception("Record not found for update");
            }
            $model->update($request->all());
            return $this->sendResponse($model, "Upadte Employee Education Successfully Added");
        } 
        catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }
}