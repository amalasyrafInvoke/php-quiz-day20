<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeJob;
use App\Models\Job;
use App\Models\JobHistory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1,10) as $index) {
            $department = new Department();
            $department->department_name = $faker->name();
            $department->save();
        }
        foreach (range(1,10) as $index) {
            $job = new EmployeeJob();
            $job->title = $faker->name();
            $job->description = $faker->text();
            $job->min_salary = $faker->numberBetween(2000, 4000);
            $job->max_salary = $faker->numberBetween(5000,10000);
            $job->save();
        }
        //
        $employee = new Employee();
        //$user = User::where('id',2);
        $employee->user_id = 2;
        $name_array =  explode(" ",'Bradly Walsh');
        $employee->first_name = $name_array[0];
        $employee->last_name = $name_array[1];
        $employee->email = 'maxine.wehner@toy.com';
        $employee->phone_number = $faker->phoneNumber();
        $employee->salary = $faker->numberBetween(5000,10000);
        $employee->department_id = 1;
        $employee->job_id = 1;
        $employee->save();


        $jobhistrory= new JobHistory();
        $jobhistrory->employee_id = 1;
        $jobhistrory->job_id = $faker->numberBetween(1, 10);
        $jobhistrory->department_id = $faker->numberBetween(1, 10);
        $jobhistrory->start_date = $faker->date();
        $jobhistrory->end_date = $faker->date();

    }
}
