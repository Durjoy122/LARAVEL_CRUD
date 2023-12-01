<?php

namespace App\Repositories;

use App\Interfaces\INurseInterface;
use App\Models\NurseProfessionalBackgroundCheck;
use App\Traits\RespondsWithHttpStatus;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Models\User;
use App\Models\NurseProfessionalInformation;
use App\Models\NurseProfessionalReferences;
use App\Models\NurseReviews;
use App\Models\NurseEducation;
use App\Models\NurseCertifications;
use App\Models\Documents;
use App\Models\NurseBooking;
use App\Models\NurseAvailability;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class NurseRepositories implements INurseInterface
{
    use RespondsWithHttpStatus;
    
    public function update_personal_information_of_nurse($request)
    {   
        try {
            $input = $request->all();
            
            if($request->has('id') && $request->id != ''){
                 $attribute = [
                    'name' => 'required',
                    'email' => 'required|email',
                    'date_of_birth' => 'required',
                    'gender' => 'required',
                    'phone' => 'required',
                    'street' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'zip' => 'required',
                    'country' => 'required'
               ];
               $input['profile_pic'] = $oldPicture = User::find($request->id)->profile_pic;
            }
            else{
                $attribute = [
                    'name' => 'required',
                    'email' => 'required|email',
                    'date_of_birth' => 'required',
                    'gender' => 'required',
                    'phone' => 'required',
                    'street' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'zip' => 'required',
                    'country' => 'required',
                    'profile_pic' => 'required|image|max:512',
                ];
            }
            

            $validator = Validator::make($request->all(), $attribute);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.',  $validator->errors());
            }

            
           // 
           
           //var_dump($request->file('profile_pic'));exit;

            if(!is_null($request->file('profile_pic')))
            {
                $profile_pic_data = $request->file('profile_pic');
                $extension = $profile_pic_data->getClientOriginalExtension();
                $destinationPath = public_path('profilePicture');
                $fileName = 'pic'.rand().'.'.$extension; 
                if (!$profile_pic_data->move($destinationPath, $fileName)) {
                    throw new Exception("Image Upload Error");
                }
                
                if(file_exists(public_path($oldPicture))){
                    unlink(public_path($oldPicture));
                }
                
                $input['profile_pic'] = '/profilePicture/'.$fileName;
            }

            $model = User::updateOrCreate(['id' => $request->id],$input);

            if(!isset($model->id)) {
                throw new Exception("Error Occured on update");
            }
            return $this->sendResponse($model, "Personal Information Updated Successfully");
        } 
        catch (Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage());
        }
    }

    public function nurse_professional_information($request)
    {
        try {
            $attribute = [
                'nurse_id' => 'required',
                'nurse_license_number' => 'required',
                'licensing_authority' => 'required',
                'license_expiry_date' => 'required',
                'years_of_experience' => 'required',
                'speciality' => 'required',
                'previous_employers' => 'required',
            ];

            $validator = Validator::make($request->all(), $attribute);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.',  $validator->errors());
            }

            $model = NurseProfessionalInformation::updateOrCreate(['id' => $request->id],$request->all());

            if(!isset($model->id)) {
                throw new Exception("Error Occured on update");
            }
            
            return $this->sendResponse($model, "Nurse Professional Information Successfully Added");

        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage());
        }
    }
    public function nurse_professional_references($request)
    {
        try {
            $attribute = [
                'nurse_id' => 'required',
                'reference_name' => 'required',
                'reference_contact_information' => 'required'
            ];

            $validator = Validator::make($request->all(), $attribute);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.',  $validator->errors());
            }

            $model = NurseProfessionalReferences::updateOrCreate(['id' => $request->id],$request->all());

            if(!isset($model->id)) {
                throw new Exception("Error Occured on update");
            }
            
            return $this->sendResponse($model, "Nurse Professional Reference Successfully done");

        } 
        catch (Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage());
        }
    }
    public function nurse_professional_background_check($request)
    {
        try {
            $attribute = [
                'nurse_id' => 'required',
                'criminal_background_check' => 'required',
                'professional_misconduct_check' => 'required'
            ];

            $validator = Validator::make($request->all(), $attribute);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.',  $validator->errors());
            }

            $model = NurseProfessionalBackgroundCheck::updateOrCreate(['id' => $request->id],$request->all());

            if(!isset($model->id)) {
                throw new Exception("Error Occured on update");
            }
            
            return $this->sendResponse($model, "Nurse Professional Background Check Successfully done");

        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage());
        }
    }
    public function nurse_education($request)
    {
        try {
            $attribute = [
                'nurse_id' => 'required',
                'degree_name' => 'required',
                'school_name' => 'required',
                'graduation_date' => 'required'
            ];

            $validator = Validator::make($request->all(), $attribute);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.',  $validator->errors());
            }

            $model =  NurseEducation::updateOrCreate(['id' => $request->id],$request->all());

            if(!isset($model->id)) {
                throw new Exception("Error Occured on update");
            }
            
            return $this->sendResponse($model, "Nurse eduucation Successfully done");

        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage());
        }
    }

    public function nurse_certifications($request)
    {
        try {
            $attribute = [
                'nurse_id' => 'required',
                'certification_name' => 'required',
                'issuing_authority' => 'required',
                'expiration_date' => 'required'
            ];

            $validator = Validator::make($request->all(), $attribute);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.',  $validator->errors());
            }

            $model = NurseCertifications::updateOrCreate(['id' => $request->id],$request->all());

            if(!isset($model->id)) {
                throw new Exception("Error Occured on update");
            }
            
            return $this->sendResponse($model, "Nurse certifications  Successfully done");

        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage());
        }
    }

    public function nurse_reviews($request)
    {
        try {
            $attribute = [
                'patient_id' => 'required',
                'nurse_id' => 'required',
                'patient_feedback' => 'required',
                'rating' => 'required|numeric',
                'testimonials' => 'required'
            ];

            $validator = Validator::make($request->all(), $attribute);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.',  $validator->errors());
            }

            $model = NurseReviews::updateOrCreate(['id' => $request->id],$request->all());

            if(!isset($model->id)) {
                throw new Exception("Error Occured on update");
            }
            
            return $this->sendResponse($model, "Nurse Reviews Successfully given");

        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage());
        }
    }

    public function nurse_upload_documents($request)
    {
        try {
            $attribute = [
                'nurse_id' => 'required',
                'type' => 'required|in:CV,LICENSE,INSURANCE,IMMUNIZATIONS',
                'documents.*' => 'required|file|mimes:jpg,jpeg,pdf,png|max:5120',
            ];

            $validator = Validator::make($request->all(), $attribute);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.',  $validator->errors());
            }

            $files=array(); $uploadedFiles =array();
            if($request->hasFile('documents')){
                $files = $request->file('documents');
                if(empty($files)){
                    throw new Exception("There is no file");
                }
                
                foreach($files as $file){
                    $Documents = new Documents();
                    $extension = $file->getClientOriginalExtension();
                    $destinationPath = public_path('nurse/'.$request->type);
                    $fileName = $request->type.'-'.$request->nurse_id.'-'.time().'.'.$extension;
                    if (!$file->move($destinationPath, $fileName)){
                        throw new Exception("Error Occured on upload");
                    }
                    $Documents->role = "NURSE";
                    $Documents->uploader_id = $request->nurse_id;
                    $Documents->document = 'nurse/'.$request->type.'/'.$fileName;
                    $Documents->type = $request->type;
                    
                    if(!$Documents->save()) {
                        throw new Exception("Error Occured on upload");
                    }

                    $uploadedFiles[] = $Documents;
                }
            }
            return $this->sendResponse($uploadedFiles, "Nurse Files Successfully Uploaded");

        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage());
        }
    }

    public function get_nurse_info($id)
    {
        try {
            $response = [];
            $ProfileScore = 1;
            $response['totalPatient'] = NurseBooking::where('nurse_id','=', $id)->where('status',1)->count();
            $response['totalExperience'] = NurseBooking::where('nurse_id','=', $id)->count();
            $response['personalInfo']= $nurse_personal_info = User::select(
                'name','email','date_of_birth','gender','phone','street','city','state','zip','country','status','profile_pic','consent_terms','concent_privecy','concent_background_check','category','availability')->where("id","=", $id)->first();
            if (isset($nurse_personal_info->id))
                $ProfileScore += 1;
            $response['professionalInfo']= $nurse_professional_info = NurseProfessionalInformation::where("nurse_id","=", $id)->get();
            if (!$nurse_professional_info->isEmpty())
                $ProfileScore += 1;
            $response['professionalReference'] = $nurse_professional_ref = NurseProfessionalReferences::where("nurse_id","=", $id)->get();
            if (!$nurse_professional_ref->isEmpty())
                $ProfileScore += 1;
            $response['professionalBackgroundCheck'] = $nurse_professional_background_check = NurseProfessionalBackgroundCheck::where("nurse_id","=", $id)->first();
            if (isset($nurse_professional_background_check->id))
                $ProfileScore += 1;
            $response['education'] = $nurse_education = NurseEducation::where("nurse_id","=", $id)->get();
            if (!$nurse_education->isEmpty())
                $ProfileScore += 1;
            $response['professionalCertification'] = $nurse_certification = NurseCertifications::where("nurse_id","=", $id)->get();
            if (!$nurse_certification->isEmpty())
                $ProfileScore += 1;
            $response['professionalDocument'] = $nurse_document = Documents::where("uploader_id","=", $id)->where('role','NURSE')->get();
            if (!$nurse_document->isEmpty())
                $ProfileScore += 1;
            $response['nurseAvailability'] = (($nurse_personal_info->availability == 0)?"Inactive":"Active");
            $response['nurseWeeklySchedule'] = NurseAvailability::where('nurse_id', $id)->get();
            $response['profileCompleteness'] = $ProfileScore == 7 ? "Complete" : "Incomplete";
            $response['totalPatient'] = NurseBooking::where('nurse_id','=', $id)->where('status',1)->count();
            $response['totalExperience'] = NurseProfessionalInformation::where('nurse_id','=', $id)->SUM('years_of_experience');

            return $this->sendResponse($response, "Information Successfully Fetched");
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), $e->getCode());
        }
    }
    
    public function get_all_nurse()
    {
        try {
            $nurses = User::where("role","=","NURSE")->paginate(50);
            if ($nurses->isEmpty()) {
                throw new Exception("No nurses Available", 400);
            }
            $id = 1;
            $nurses->map(function($nurse) use ($id) {
                $nurse->currentState = Cache::get($nurse->role.'-'.$nurse->id) == ""?false:Cache::get($nurse->role.'-'.$nurse->id); 
                return $nurse;
            });

            return $this->sendResponse($nurses,"Nurse List");
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), $e->getCode());
        }
    }

    public function set_weekly_schedule($request)
    {
        $input = [];
        try {
            if ($this->get_nurse_info($request->nurse_id)->getData()->data->profileCompleteness != 'Complete') {
                throw new Exception("Your profile is incomplete. Please complete your profile first", 400);
            }
            $dayNumberArray = ["Monday"=> "1","Tuesday"=> "2","Wednesday"=> "3","Thursday"=> "4","Friday"=> "5","Saturday"=> "6","Sunday"=> "7"];
            $attribute = [
                'nurse_id' => 'required',
                'day_name' => 'required',
                'office_start_time' => 'required|date_format:H:i:s',
                'office_end_time' => 'required|date_format:H:i:s',
                'break_start_time' => 'required|date_format:H:i:s',
                'break_end_time' => 'required|date_format:H:i:s',
            ];

            $validator = Validator::make($request->all(), $attribute);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.',  $validator->errors());
            }

            if($request->has('day_name') && COUNT(explode(',', $request->day_name)) > 0){

                $daysArray = explode(',',$request->day_name);
                NurseAvailability::where('nurse_id',$request->nurse_id)->delete();
                foreach ($daysArray as $day) {
                        $input['nurse_id'] = $request->nurse_id;
                        $input['day'] = $dayNumberArray[$day];
                        $input['day_name'] = $day;
                        $input['start_time'] = date('H:i:s', strtotime($request->office_start_time));
                        $input['end_time'] = date('H:i:s', strtotime($request->office_end_time));
                        $input['break_time_start'] = date('H:i:s', strtotime($request->break_start_time));
                        $input['break_time_end'] = date('H:i:s', strtotime($request->break_end_time));
                        NurseAvailability::create($input); 
                }
                $allAvailableDay = NurseAvailability::where('nurse_id',$request->nurse_id)->get();
                if (!$allAvailableDay->isEmpty()) {
                    User::where('id',$request->nurse_id)->update(['availability'=>1]);
                }
                return $this->sendResponse($allAvailableDay,"allAvailableDay List");
            } else {
                throw new Exception("No day Name Available", 400);
            }
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), $e->getCode());
        }
    }

    public function set_availability($request)
    {
        try {
            
            if ($this->get_nurse_info($request->nurse_id)->getData()->data->profileCompleteness != 'Complete') {
                throw new Exception("Your profile is incomplete. Please complete your profile first", 400);
            }

            $attribute = [
                'nurse_id' => 'required',
                'available' => 'required|int'
            ];

            $validator = Validator::make($request->all(), $attribute);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.',  $validator->errors());
            }

            if($request->available == 1){
                User::where('id',$request->nurse_id)->update(['availability'=> 1]);
                return $this->sendResponse("ACTIVE","Nurse is now Available");
            }else{
                User::where('id',$request->nurse_id)->update(['availability'=> 0]);
                return $this->sendResponse("INACTIVE","Nurse is now Not Available");
            }
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), $e->getCode());
        }
    }

}