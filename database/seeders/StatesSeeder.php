<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public $states = [
        'Alabama',
        'Alaska',
        'Arizona',
        'Arkansas',
        'California',
        'Colorado',
        'Connecticut',
        'Delaware',
        'District of Columbia',
        'Florida',
        'Georgia',
        'Hawaii',
        'Idaho',
        'Illinois',
        'Indiana',
        'Iowa',
        'Kansas',
        'Kentucky',
        'Louisiana',
        'Maine',
        'Maryland',
        'Massachusetts',
        'Michigan',
        'Minnesota',
        'Mississippi',
        'Missouri',
        'Montana',
        'Nebraska',
        'Nevada',
        'New Hampshire',
        'New Jersey',
        'New Mexico',
        'New York',
        'North Carolina',
        'North Dakota',
        'Ohio',
        'Oklahoma',
        'Oregon',
        'Pennsylvania',
        'Rhode Island',
        'South Carolina',
        'South Dakota',
        'Tennessee',
        'Texas',
        'Utah',
        'Vermont',
        'Virginia',
        'Washington',
        'West Virginia',
        'Wisconsin',
        'Wyoming',

        // Commonwealth/Territory and Military
//        'American Samoa',
//        'District of Columbia',
//        'Federated States of Micronesia',
//        'Guam',
//        'Marshall Islands',
//        'Northern Mariana Islands',
//        'Palau',
//        'Puerto Rico',
//        'Virgin Islands',
//        'Armed Forces Americas',
//        'Armed Forces Canada / Europe / Middle East / Africa',
//        'Armed Forces Pacific',
    ];


    public $UK_states = [
        "England", "Wales", "Scotland", "Northern Ireland"
    ];

    public function run()
    {
        foreach ($this->states as $state){
            DB::table('country_states')->insert([
                'country_id' => 4,
                'name' => $state,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }

        foreach ($this->UK_states as $UK_state){
            DB::table('country_states')->insert([
                'country_id' => 5,
                'name' => $UK_state,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
