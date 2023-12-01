<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NurseProfessionalReferences extends Model
{
    use HasFactory;
    protected $table = 'nurse_professional_references';

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';

    protected $fillable = ['nurse_id', 'reference_name', 'reference_contact_information'];
}
