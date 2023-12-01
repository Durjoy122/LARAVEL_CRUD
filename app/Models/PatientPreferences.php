<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientPreferences extends Model
{
    use HasFactory;

    protected $table = 'patient_preferences';

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';

    protected $fillable = ['patient_id' , 'pharmacy_name' , 'pharmacy_address' , 'method_of_communication'];
}
