<?php

namespace App\Repositories;

use App\Interfaces\IPatientInterface;
use App\Traits\RespondsWithHttpStatus;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Models\User;
use App\Models\PatientMedicalInformation;
use App\Models\PatientInsuranceInformation;
use App\Models\PatientEmergencyContact;
use App\Models\PatientPreferences;
use File;    

class PatientRepositories implements IPatientInterface
{
    use RespondsWithHttpStatus;
    
    public function update_personal_information_of_patient($request)
    {   
        try {
            $input = $request->all();
            if($request->has('id') && $request->id != ''){
                 $attribute = [
                'name' => 'required','email' => 'required|email','date_of_birth' => 'required','gender' => 'required','phone' => 'required','street' => 'required','city' => 'required','state' => 'required','zip' => 'required','country' => 'required'
                ];
               $input['profile_pic'] = $oldPicture = User::find($request->id)->profile_pic;
            }else{
                $attribute = [
                'name' => 'required','email' => 'required|email','date_of_birth' => 'required','gender' => 'required','phone' => 'required','street' => 'required','city' => 'required','state' => 'required','zip' => 'required','country' => 'required','profile_pic' => 'required|image|max:512',
                ];
            }

            $validator = Validator::make($request->all(), $attribute);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.',  $validator->errors());
            }

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

        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage());
        }
    }

    public function patient_emergency_contact($request)
    {
        try {
            $attribute = [
                'patient_id' => 'required',
                'emergency_contact_name' => 'required',
                //'known_allergies' => 'required',
                //'current_medications' => 'required',
                //'medical_history' => 'required',
                //'family_medical_history' => 'required',
                'relationship_to_patient' => 'required',
                'emergency_contact_phone' => 'required'
            ];

            $validator = Validator::make($request->all(), $attribute);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.',  $validator->errors());
            }

            $model = PatientEmergencyContact::updateOrCreate(['id' => $request->id],$request->all());

            if(!isset($model->id)) {
                throw new Exception("Error Occured on update");
            }
            
            return $this->sendResponse($model, "Emergency Contact Stored Successfully");

        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage());
        }
    }

    public function patient_insurance_information($request)
    {
        try {
            $attribute = [
                'patient_id' => 'required',
                'insurance_provider' => 'required',
                //'known_allergies' => 'required',
                //'current_medications' => 'required',
                //'medical_history' => 'required',
                //'family_medical_history' => 'required',
                'policy_number' => 'required',
                'insurance_contact_information' => 'required'
            ];

            $validator = Validator::make($request->all(), $attribute);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.',  $validator->errors());
            }

            $model = PatientInsuranceInformation::updateOrCreate(['id' => $request->id],$request->all());

            if(!isset($model->id)) {
                throw new Exception("Error Occured on update");
            }
            
            return $this->sendResponse($model, "Insurance Information Stored Successfully");

        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage());
        }
    }

    public function patient_medical_information($request)
    {
        try {
            $attribute = [
                'patient_id' => 'required',
                'blood_type' => 'required',
                //'known_allergies' => 'required',
                //'current_medications' => 'required',
                //'medical_history' => 'required',
                //'family_medical_history' => 'required',
                'pc_physician_name' => 'required',
                'pc_physician_contact' => 'required'
            ];

            $validator = Validator::make($request->all(), $attribute);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.',  $validator->errors());
            }

            $model = PatientMedicalInformation::updateOrCreate(['id' => $request->id],$request->all());

            if(!isset($model->id)) {
                throw new Exception("Error Occured on update");
            }
            
            return $this->sendResponse($model, "User Medical Information Stored Successfully");

        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage());
        }
    }

    public function patient_preferences($request)
    {
        try {
            $attribute = [
                'patient_id' => 'required',
                'pharmacy_name' => 'required',
                'pharmacy_address' => 'required',
                'method_of_communication' => 'required'
            ];

            $validator = Validator::make($request->all(), $attribute);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.',  $validator->errors());
            }

            $model = PatientPreferences::updateOrCreate(['id' => $request->id],$request->all());

            if(!isset($model->id)) {
                throw new Exception("Error Occured on update");
            }
            
            return $this->sendResponse($model, "Patient Preferences Stored Successfully");

        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage());
        }
    }

    public function get_patient_info($id)
    {
        try {
            $response = [];
            $ProfileScore = 1;
            $response['personalInfo']=$patient_personal_info = User::select(
                'name','email','date_of_birth','gender','phone','street','city','state','zip','country','status','profile_pic','consent_terms','concent_privecy','medical_treatment_auth')->where("id","=", $id)->first();
            if (isset($patient_personal_info->id))
                $ProfileScore += 1;
            $response['patientEmergencyContact']= $patientEmergencyContact = PatientEmergencyContact::where("patient_id","=", $id)->get();
            if (!$patientEmergencyContact->isEmpty())
                $ProfileScore += 1;
            $response['patientInsurance'] = $patientInsuranceNumber = PatientInsuranceInformation::where("patient_id","=", $id)->get();
            if (!$patientInsuranceNumber->isEmpty())
                $ProfileScore += 1;
            $response['patientMedicalInformation'] = $patientMedicalInfo = PatientMedicalInformation::where("patient_id","=", $id)->first();
            if (isset($patientMedicalInfo->id))
                $ProfileScore += 1;
            // $response['patientPreferences'] = $patientPreferences = PatientPreferences::where("patient_id","=", $id)->get();
            // if (!$patientPreferences->isEmpty())
            //     $ProfileScore += 1;
            $response['profileCompleteness'] = $ProfileScore == 4 ? "Complete" : "Incomplete";
            
            return $this->sendResponse($response, "Information Successfully Fetched");
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), $e->getCode());
        }
    }

}