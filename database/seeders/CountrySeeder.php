<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CountrySeeder extends Seeder
{
    public function run()
    {
        $list = json_decode(File::get(database_path('data/countries.json')), true);

        foreach ($list as $item) {
            DB::table('countries')->updateOrInsert(
                ['alpha2_code' => strtoupper($item['alpha2_code']),  
                'alpha3_code'  => strtoupper($item['alpha3_code']),
                'english_name' => $item['english_name'],         
                'arabic_name'  => $item['arabic_name'],          
                'phone_code'   => $item['phone_code'],           
                'updated_at'   => now(),
                'created_at'   => now(),
                ]
            );
        }
    }
}
