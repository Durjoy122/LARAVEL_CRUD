<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface INurseInterface
{
    public function update_personal_information_of_nurse($request);
    public function nurse_professional_information($request);
    public function nurse_professional_references($request);
    public function nurse_professional_background_check($request);
    public function nurse_education($request);
    public function nurse_certifications($request);
    public function nurse_reviews($request);
    public function nurse_upload_documents($request);
    public function get_nurse_info($id);
    public function get_all_nurse();
    public function set_weekly_schedule($request);
    public function set_availability($request);  
    
}