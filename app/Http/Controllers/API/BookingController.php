<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\IBookingInterface;

class BookingController extends Controller
{
    private IBookingInterface $bookingRepository;
    public function __construct(IBookingInterface $bookingRepository) 
    {
        $this->bookingRepository = $bookingRepository;
    }

    public function get_available_booking_slot(Request $request)
    {
        return $this->bookingRepository->get_available_booking_slot($request);
    }
    public function book_appointment(Request $request)
    {
        return $this->bookingRepository->book_appointment($request);
    }
}