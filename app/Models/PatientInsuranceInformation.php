<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientInsuranceInformation extends Model
{
    use HasFactory;

    protected $table = 'patient_insurance_information';

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';

    protected $fillable = ['patient_id' , 'insurance_provider' , 'policy_number' , 'insurance_contact_information'];
}
