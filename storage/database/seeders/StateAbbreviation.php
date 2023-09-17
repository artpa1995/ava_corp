<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateAbbreviation extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

     public  $us_state_abbrevs_names = array(
        'Alabama'  => 'AL',  
        'Alaska'  => 'AK',  
        'AMERICAN SAMOA'  => 'AS',  
        'Arizona' => 'AZ',  
        'Arkansas' => 'AR',  
        'California' => 'CA',  
        'Colorado' => 'CO',  
        'Connecticut' => 'CT',  
        'Delaware' => 'DE',  
        'District of Columbia' => 'DC',  
        'FEDERATED STATES OF MICRONESIA' => 'FM',  
        'Florida' => 'FL',  
        'Georgia' => 'GA',  
        'GUAM GU' => 'GU',  
        'Hawaii' => 'HI',  
        'Idaho' => 'ID',  
        'Illinois' => 'IL',  
        'Indiana' => 'IN',  
        'Iowa' => 'IA',  
        'Kansas' => 'KS',  
        'Kentucky' => 'KY',  
        'Louisiana' => 'LA',  
        'Maine' => 'ME',  
        'MARSHALL ISLANDS' => 'MH',  
        'Maryland' => 'MD',  
        'Massachusetts' => 'MA',  
        'Michigan' => 'MI',  
        'Minnesota' => 'MN',  
        'Mississippi' => 'MS',  
        'Missouri' => 'MO',  
        'Montana' => 'MT',  
        'Nebraska' => 'NE',  
        'Nevada' => 'NV',  
        'New Hampshire' => 'NH',  
        'New Jersey' => 'NJ',  
        'New Mexico' => 'NM',  
        'New York' => 'NY',  
        'North Carolina' => 'NC',  
        'North Dakota' => 'ND',  
        'NORTHERN MARIANA ISLANDS' => 'MP',  
        'Ohio' => 'OH',  
        'Oklahoma' => 'OK',  
        'Oregon' => 'OR',  
        'PALAU' => 'PW',  
        'Pennsylvania' => 'PA', 
        'PUERTO RICO' => 'PR',  
        'Rhode Island' => 'RI',  
        'South Carolina' => 'SC',  
        'South Dakota' => 'SD',  
        'Tennessee' => 'TN',  
        'Texas' => 'TX',  
        'Utah' => 'UT',  
        'Vermont' => 'VT',  
        'VIRGIN ISLANDS' => 'VI',  
        'Virginia' => 'VA',  
        'Washington' => 'WA',  
        'West Virginia' => 'WV',  
        'Wisconsin' => 'WI',  
        'Wyoming'  => 'WY'  
    );

    public function run()
    {
        foreach ($this->us_state_abbrevs_names as $key => $abbreviation){
            DB::table('country_states')
                ->where('name', $key)
                ->update(array('abbreviation' => $abbreviation));
        }

    }
}
