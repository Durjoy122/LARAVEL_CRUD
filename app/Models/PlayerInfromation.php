<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerInfromation extends Model
{
    use HasFactory;
    protected $table = 'player_information';

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';

    protected $fillable = ['first_name', 'last_name', 'phone', 'address', 'email', 'gender'];
}
