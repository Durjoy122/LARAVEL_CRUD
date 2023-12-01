<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NurseAvailability extends Model
{
    use HasFactory;

    protected $table = 'nurse_availability';

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';

    protected $fillable = ['nurse_id' ,'day','day_name', 'start_time','end_time','break_time_start','break_time_end'];
}
