<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CompanyTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

     public $company_types = [
        'Competitor',
        'Client',
        'Integrator',
        'Investor',
        'Partner',
        'Press',
        'Prospect',
        'Reseller',
        'Other',
        'Analyst',
     ];
     
    public function run()
    {
        foreach ($this->company_types as $company_type){
            DB::table('company_types')->insert([
                'name' => $company_type,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
       
    }
}
