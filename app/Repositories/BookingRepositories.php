<?php

namespace App\Repositories;

use App\Interfaces\INurseInterface;
use App\Interfaces\IBookingInterface;
use App\Interfaces\IPatientInterface;
use App\Traits\RespondsWithHttpStatus;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Models\User;
use App\Models\NurseBooking;
use App\Models\NurseAvailability;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class BookingRepositories implements IBookingInterface
{
    use RespondsWithHttpStatus;
    private IPatientInterface $patientRepository;
    private INurseInterface $nurseRepository;

    public function __construct(IPatientInterface $patientRepository, INurseInterface $nurseRepository) 
    {
        $this->patientRepository = $patientRepository;
        $this->nurseRepository = $nurseRepository;
    }
    public function get_available_booking_slot($request)
    {
        try {
            $attribute = [
                'patient_id' => 'required|int',
                'nurse_id' => 'required|int',
                'date'=>'required|date_format:Y-m-d'
            ];

            $validator = Validator::make($request->all(), $attribute);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.',  $validator->errors());
            }

            if ($this->patientRepository->get_patient_info($request->patient_id)->getData()->data->profileCompleteness != 'Complete') {
                throw new Exception("Your profile is incomplete. Please complete your profile first", 400);
            }

            return $this->sendResponse("","allAvailableDay List");
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), $e->getCode());
        }
    }

    public function book_appointment($request)
    {
        try {

            $attribute = [
                'patient_id' => 'required|int'
            ];

            $validator = Validator::make($request->all(), $attribute);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.',  $validator->errors());
            }

            if ($this->patientRepository->get_patient_info($request->patient_id)->getData()->data->profileCompleteness != 'Complete') {
                throw new Exception("Your profile is incomplete. Please complete your profile first", 400);
            }

            return $this->sendResponse("","allAvailableDay List");
            
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), $e->getCode());
        }
    }

}