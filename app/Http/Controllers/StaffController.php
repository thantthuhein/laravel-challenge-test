<?php

namespace App\Http\Controllers;

use App\Services\EmployeeManagement\Staff;

class StaffController
{
    public function __invoke(Staff $staff)
    {
        $data = $staff->salary();

        return response()->json([
            'data' => $data
        ]);
    }
}
