<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientEmergencyContact extends Model
{
    use HasFactory;

    protected $table = 'patient_emergency_contact';

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';

    protected $fillable = ['patient_id' , 'emergency_contact_name' , 'relationship_to_patient' , 'emergency_contact_phone'];
}
