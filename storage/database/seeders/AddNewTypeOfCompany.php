<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AddNewTypeOfCompany extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public $company_types = [

     "Einzelunternehmen",
     "Gesellschaft bürgerlichen Rechts",
     "Eingetragener Kaufmann",
     "Offene Handelsgesellschaft",
     "Kommanditgesellschaft",
     "Gesellschaft mit beschränkter Haftung",
     "Unternehmergesellschaft",
     "Aktiengesellschaft",
     "GmbH & Co KG"
    ];

    public function run()
    {
        foreach ($this->company_types as $company_type){
            DB::table('type_of_companeis')->insert([
                'name' => $company_type,
                'countries' => '[16,3,114,54]',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }

    }
}
