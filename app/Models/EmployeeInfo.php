<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeInfo extends Model
{
    use HasFactory;

    protected $table = 'employee_records';

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';

    protected $fillable = ['first_name' ,'last_name', 'phone' ,'email', 'address', 'education'];
}
