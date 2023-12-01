<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\INurseInterface;
use Illuminate\Http\Request;

class NurseController extends Controller
{
    private INurseInterface $nurseRepository;

    public function __construct(INurseInterface $nurseRepository) 
    {
        $this->nurseRepository = $nurseRepository;
    }

    public function update_personal_information_of_nurse(Request $request)
    {
        return $this->nurseRepository->update_personal_information_of_nurse($request);
    }

    public function nurse_professional_information(Request $request)
    {
        return $this->nurseRepository->nurse_professional_information($request);
    }
    public function nurse_professional_references(Request $request)
    {
        return $this->nurseRepository->nurse_professional_references($request);
    }
    public function nurse_professional_background_check(Request $request)
    {
        return $this->nurseRepository->nurse_professional_background_check($request);
    }
    public function nurse_education(Request $request)
    {
        return $this->nurseRepository->nurse_education($request);   
    }
    public function nurse_certifications(Request $request)
    {
        return $this->nurseRepository->nurse_certifications($request);
    }
    public function nurse_reviews(Request $request)
    {
        return $this->nurseRepository->nurse_reviews($request);
    }

    public function nurse_upload_documents(Request $request)
    {
        return $this->nurseRepository->nurse_upload_documents($request);
    }

    public function get_nurse_info($id)  
    {
        return $this->nurseRepository->get_nurse_info($id);
    }  

    public function get_all_nurse()  
    {
        return $this->nurseRepository->get_all_nurse();
    }  

    public function set_weekly_schedule(Request $request)  
    {
        return $this->nurseRepository->set_weekly_schedule($request);
    }

    public function set_availability(Request $request)
    {
        return $this->nurseRepository->set_availability($request);
    }

}