<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NurseEducation extends Model
{
    use HasFactory;
    protected $table = 'nurse_education';

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';

    protected $fillable = ['nurse_id' , 'degree_name' , 'school_name' , 'graduation_date'];
}
