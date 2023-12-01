<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NurseBooking extends Model
{
    use HasFactory;

    protected $table = 'nurse_booking';
    
    const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';

    protected $fillable = ['nurse_id' ,'patient_id' ,'booking_date'  ,'status', 'day', 'day_name'];
}
