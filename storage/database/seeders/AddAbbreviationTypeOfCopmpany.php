<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddAbbreviationTypeOfCopmpany extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

     public $types = array(
         'C-Corporation' => 'C-Corp',
         'Limited by Guarantee' => 'LBG',
         'Limited Liability Company' => 'LLC',
         'Limited Partnership' => 'LP',
         'Private Limited Company' => 'LTD',
         'Public Limited Company' => 'PLC',
         'Einzelunternehmen' => 'e.U.',
         'Gesellschaft bürgerlichen Rechts' => 'GbR',
         'Eingetragener Kaufmann' => 'e.K.',
         'Offene Handelsgesellschaft' => 'OHG',
         'Kommanditgesellschaft' => 'KG',
         'Gesellschaft mit beschränkter Haftung' => 'GmbH',
         'Unternehmergesellschaft' => 'UG',
         'Aktiengesellschaft' => 'AG',
         'GmbH & Co KG' => 'GmbH & Co KG',
      );

    public function run()
    {
        foreach ($this->types as $key => $value){
            DB::table('type_of_companeis')
                ->where('name', $key)
                ->update(array('abbreviation' => $value));
        }

    }
}
