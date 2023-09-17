<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TypeOfCompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public $company_types = [
        "C-Corporation",
        "Limited by Guarantee",
        "Limited Liability Company",
        "Limited Partnership",
        "Private Limited Company",
        "Public Limited Company",
    ];

    public function run()
    {
        foreach ($this->company_types as $company_type){
            DB::table('type_of_companeis')->insert([
                'name' => $company_type,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }

    }
}
