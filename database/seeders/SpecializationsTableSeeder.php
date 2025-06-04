<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecializationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specializations = [
            'Admin/Human Resources' => ['Clerical/Administrative Support', 'Human Resources', 'Secretarial/Executive Personal Assistant', 'Top Management'],
            'Sales/Marketing' => ['Marketing/Business Dev', 'Sales-Corporate', 'Sales-Eng/Tech/IT', 'Sales-Financial Services', 'Retail Sales', 'Merchandising', 'Telesales/Telemarketing', 'E-Commerce', 'Digital Marketing'],
            'Accounting/Finance' => ['Audit & Taxation', 'Banking/Financial', 'Corporate Finance/Investment', 'General/Cost Accounting'],
            'Arts/Media/Communication' => ['Advertising', 'Arts/Creative Design', 'Entertainment', 'Public Relations'],
            'Services' => ['Security/Armed Forces', 'Customer Service', 'Logistics/Supply Chain', 'Law/Legal Services', 'Personal Care', 'Social Services', 'Tech & Helpdesk Support'],
            'Hotel/Restaurant' => ['Food/Beverage/Restaurant', 'Hotel/Tourism'],
            'Education/Training' => ['Education', 'Training and Development', 'Academe Researcher'],
            'Computer/Information Technology' => ['IT-Hardware', 'IT-Network/Sys/DB Admin', 'IT-Software'],
            'Engineering' => ['Chemical Engineering','Electrical Engineering','Electronics Engineering','Environmental Engineering','Industrial Engineering','Mechanical/Automotive Engineering','Oil/Gas Engineering','Other Engineering Jobs'],
            'Manufacturing' => ['Maintenance','Manufacturing','Process Design and Control','Purchasing/ Material Management','Quality Assurance'],
            'Building/Construction' =>['Architect/Interior Design','Civil Engineering/Construction','Property/Real Estate','Quantity Surveying'],
            'Sciences' => ['Actuarial/Statistics','Agriculture','Aviation','Biomedical','Biotechnology','Chemistry','Food Tech/Nutritionist','Geology/Geophysics','Science & Technology'],
            'Healthcare' => ['Doctor/Diagnosis','Pharmacy','Nurse/Medical Support'],
            'Others' => ['General Work','Journalist/Editor','Publishing'],
        ];

        foreach ($specializations as $specialization => $subSpecializations) {
            // Insert specialization
            $specializationId = DB::table('specializations')->insertGetId([
                'name' => $specialization,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Insert related sub-specializations
            foreach ($subSpecializations as $subSpecialization) {
                DB::table('sub_specializations')->insert([
                    'specialization_id' => $specializationId,
                    'name' => $subSpecialization,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
