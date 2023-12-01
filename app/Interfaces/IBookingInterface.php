<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface IBookingInterface
{
    public function get_available_booking_slot($request);
    public function book_appointment($request); 
    
}