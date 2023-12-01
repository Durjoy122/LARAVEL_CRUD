<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface IPatientInterface
{
    public function update_personal_information_of_patient($request);
    public function patient_emergency_contact($request);
    public function patient_insurance_information($request);
    public function patient_medical_information($request);
    public function patient_preferences($request);
    public function get_patient_info($request);
}