<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NurseCertifications extends Model
{
    use HasFactory;

    protected $table = 'nurse_certifications';

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';

    protected $fillable = ['nurse_id' , 'certification_name' , 'issuing_authority' , 'expiration_date'];
}
