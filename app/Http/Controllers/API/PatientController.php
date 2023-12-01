<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\IPatientInterface;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    private IPatientInterface $patientRepository;

    public function __construct(IPatientInterface $patientRepository) 
    {
        $this->patientRepository = $patientRepository;
    }

    public function update_personal_information_of_patient(Request $request)
    {
        return $this->patientRepository->update_personal_information_of_patient($request);
    }

    public function patient_emergency_contact(Request $request)
    {
        return $this->patientRepository->patient_emergency_contact($request);
    }

    public function patient_insurance_information(Request $request)
    {
        return $this->patientRepository->patient_insurance_information($request);
    }

    public function patient_medical_information(Request $request)
    {
       return $this->patientRepository->patient_medical_information($request);
    }

    public function patient_preferences(Request $request)
    {
        return $this->patientRepository->patient_preferences($request);
    }

    public function get_patient_info($id)
    {
        return $this->patientRepository->get_patient_info($id);
    }

}