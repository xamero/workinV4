<?php

namespace Database\Seeders;

use App\Models\AddressRegion;
use App\Models\AddressBarangay;
use App\Models\AddressProvince;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\AddressCityMunicipality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        AddressBarangay::truncate();
        AddressCityMunicipality::truncate();
        AddressProvince::truncate();
        AddressRegion::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $csvFile = fopen(base_path("database/csv/PSGC.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                if($data['3'] == 'Bgy'){
                    $name = $data['1'];

                    // check oldname
                    if(!empty($data['4'])){
                        $name = $name." (".$data['4'].")";
                    }

                    // check status
                    if(!empty($data['12'])){
                        $name = $name." (".$data['12'].")";
                    }

                    $psgc_code = $data['0'];
                    // get city municipality
                    $psgc_code2 = $psgc_code - ($psgc_code % 1000);
                    // $cityMunicipality = AddressCityMunicipality::where('psgc_code', $psgc_code2)->first();
                    $cityMunicipality = AddressCityMunicipality::get()->last();

                    AddressBarangay::create([
                        'psgc_code' => $data['0'],
                        'name' => $data['1'],
                        'old_name' => $data['4'],
                        'status' => $data['12'],
                        'city_municipality_id' => $cityMunicipality['id'],
                        'fullname' => $name,
                    ]);
                }

                if($data['3'] == 'Mun' || $data['3'] == 'City'){
                    $name = $data['1'];

                    // check oldname
                    if(!empty($data['4'])){
                        $name = $name." (".$data['4'].")";
                    }

                    // check status
                    if(!empty($data['12'])){
                        $name = $name." (".$data['12'].")";
                    }

                    $psgc_code = $data['0'];
                    // get province
                    $psgc_code2 = $psgc_code - ($psgc_code % 100000);
                    // $province = AddressProvince::where('psgc_code', $psgc_code2)->first();
                    $province = AddressProvince::get()->last();

                    AddressCityMunicipality::create([
                        'psgc_code' => $data['0'],
                        'name' => $data['1'],
                        'old_name' => $data['4'],
                        'status' => $data['12'],
                        'province_id' => $province['id'],
                        'fullname' => $name,
                    ]);
                }

                if($data['3'] == 'Prov'){
                    $name = $data['1'];

                    // check oldname
                    if(!empty($data['4'])){
                        $name = $name." (".$data['4'].")";
                    }

                    // check status
                    if(!empty($data['12'])){
                        $name = $name." (".$data['12'].")";
                    }

                    $psgc_code = $data['0'];
                    // get region
                    $psgc_code2 = $psgc_code - ($psgc_code % 100000000);
                    // $region = AddressRegion::where('psgc_code', $psgc_code2)->first();
                    $region = AddressRegion::get()->last();

                    AddressProvince::create([
                        'psgc_code' => $data['0'],
                        'name' => $data['1'],
                        'old_name' => $data['4'],
                        'status' => $data['12'],
                        'region_id' => $region['id'],
                        'fullname' => $name,
                    ]);
                }

                if($data['3'] == 'Reg'){
                    $name = $data['1'];

                    // check oldname
                    if(!empty($data['4'])){
                        $name = $name." (".$data['4'].")";
                    }

                    // check status
                    if(!empty($data['12'])){
                        $name = $name." (".$data['12'].")";
                    }

                    AddressRegion::create([
                        'psgc_code' => $data['0'],
                        'name' => $data['1'],
                        'old_name' => $data['4'],
                        'status' => $data['12'],
                        'fullname' => $name,
                    ]);
                }
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
