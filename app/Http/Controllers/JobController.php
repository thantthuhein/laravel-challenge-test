<?php

namespace App\Http\Controllers;

use App\Services\EmployeeManagement\Applicant;

class JobController
{
    public function __invoke(Applicant $applicant)
    {
        $data = $applicant->applyJob();

        return response()->json([
            'data' => $data
        ]);
    }
}
