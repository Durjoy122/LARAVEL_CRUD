<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NurseProfessionalInformation extends Model
{
    use HasFactory;
    protected $table = 'nurse_professional_information';

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';

    protected $fillable = ['nurse_id', 'nurse_license_number', 'licensing_authority', 'license_expiry_date', 'years_of_experience' , 'speciality', 'previous_employers'];
}
