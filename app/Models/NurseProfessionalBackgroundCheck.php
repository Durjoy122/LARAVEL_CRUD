<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NurseProfessionalBackgroundCheck extends Model
{
    use HasFactory;

    protected $table = 'nurse_professional_background_check';

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';

    protected $fillable = ['nurse_id' , 'criminal_background_check' , 'professional_misconduct_check'];
}
