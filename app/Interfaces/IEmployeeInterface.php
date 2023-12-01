<?php

namespace App\Interfaces;

interface IEmployeeInterface
{
    public function employee_personal_information($request);
    public function employee_delete($id);
    public function if_check_true($request);
    public function employee_result($request);
    public function employee_result_up($request);
}