<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NurseReviews extends Model
{
    use HasFactory;

    protected $table = 'nurse_reviews';

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';

    protected $fillable = ['patient_id' , 'nurse_id' , 'patient_feedback' , 'rating','testimonials'];
}
