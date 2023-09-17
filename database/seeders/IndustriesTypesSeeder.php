<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class IndustriesTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

     public $industries_types = [
        'Agriculture',
        'Apparel',
        'Banking',
        'Biotechnology',
        'Chemicals',
        'Communications',
        'Construction',
        'Consulting',
        'Education',
        'Electronics',
        'Energy',
        'Engineering',
        'Entertainment',
        'Environmental',
        'Finance',
        'Food & Beverage',
        'Government',
        'Healthcare',
        'Hospitality',
        'Insurance',
        'Machinery',
        'Manufacturing',
        'Media',
        'Not For Profit',
        'Other',
        'Recreation',
        'Retail',
        'Shipping',
        'Technology',
        'Telecommunications',
        'Transportation',
        'Utilities'
     ];

    public function run()
    {
         foreach ($this->industries_types as $industries_type){
            DB::table('industries_types')->insert([
                'name' => $industries_type,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    
    }
}
