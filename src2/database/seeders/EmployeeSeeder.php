<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($data)
    {
        Employee::create(
            [
                'employee_name' => $data->employee_name,
                'employee_gender' => $data->employee_gender,
                'employee_status' => $data->employee_status,
                'employee_feature_img' => $data->employee_feature_img,
                'outlet_id' => $data->outlet_id,
                'created_by' => $data->created_by
            ]
        );
    }
}
