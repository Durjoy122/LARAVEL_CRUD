<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientMedicalInformation extends Model
{
    use HasFactory;

    protected $table = 'patient_medical_information';

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';

    protected $fillable = ['patient_id' ,'blood_type', 'known_allergies' ,'current_medications' ,'medical_history', 'family_medical_history', 'pc_physician_name', 'pc_physician_contact', 'updated_by'];

}
