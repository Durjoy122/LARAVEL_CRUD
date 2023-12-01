<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NurseCategories extends Model
{
    use HasFactory;

    protected $table = 'categories';
    
    const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';

    protected $fillable = ['name'];
}
