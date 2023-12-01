<?php

namespace App\Http\Controllers;
use App\Interfaces\IEmployeeInterface;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    private IEmployeeInterface $employeeRepository;

    public function __construct(IEmployeeInterface  $employeeRepository) 
    {
        $this->employeeRepository = $employeeRepository;
    }
    public function  employee_personal_information(Request $request)
    {
        return $this->employeeRepository->employee_personal_information($request);
    }

    public function employee_delete($id) {
        return $this->employeeRepository->employee_delete($id);
    }
    public function if_check_true(Request $request) {
        return $this->employeeRepository->if_check_true($request);
    }

    public function  employee_result(Request $request) {
        return $this->employeeRepository->employee_result($request);
    }
    public function employee_result_up(Request $request) {
        return $this->employeeRepository->employee_result_up($request); 
    }
}
