<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeResult extends Model
{
    use HasFactory;
    protected $table = 'employee_educations';

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';

    protected $fillable = ['name' , 'psc_score' , 'ssc_score' , 'hsc_score', 'ba_score' , 'ma_score' , 'phd'];
}
