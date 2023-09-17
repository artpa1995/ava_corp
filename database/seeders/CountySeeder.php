<?php

namespace Database\Seeders;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class CountySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


   

    public $england = [
        'Bedfordshire',
        'Berkshire',
        'Bristol',
        'Buckinghamshire',
        'Cambridgeshire',
        'Cheshire',
        'City of London',
        'Cornwall',
        'Cumbria',
        'Derbyshire',
        'Devon',
        'Dorset',
        'Durham',
        'East Riding of Yorkshire',
        'East Sussex',
        'Essex',
        'Gloucestershire',
        'Greater London',
        'Greater Manchester',
        'Hampshire',
        'Herefordshire',
        'Hertfordshire',
        'Isle of Wight',
        'Kent',
        'Lancashire',
        'Leicestershire',
        'Lincolnshire',
        'Merseyside',
        'Norfolk',
        'North Yorkshire',
        'Northamptonshire',
        'Northumberland',
        'Nottinghamshire',
        'Oxfordshire',
        'Rutland',
        'Shropshire',
        'Somerset',
        'South Yorkshire',
        'Staffordshire',
        'Suffolk',
        'Surrey',
        'Tyne and Wear',
        'Warwickshire',
        'West Midlands',
        'West Sussex',
        'West Yorkshire',
        'Wiltshire',
        'Worcestershire',
    ];


    public $wales = [
        'Anglesey',
        'Brecknockshire',
        'Caernarfonshire',
        'Carmarthenshire',
        'Cardiganshire',
        'Denbighshire',
        'Flintshire',
        'Glamorgan',
        'Merioneth',
        'Monmouthshire',
        'Montgomeryshire',
        'Pembrokeshire',
        'Radnorshire',
    ];

    public $scotland = [
        'Aberdeenshire',
        'Angus',
        'Argyllshire',
        'Ayrshire',
        'Banffshire',
        'Berwickshire',
        'Buteshire',
        'Cromartyshire',
        'Caithness',
        'Clackmannanshire',
        'Dumfriesshire',
        'Dunbartonshire',
        'East Lothian',
        'Fife',
        'Inverness-shire',
        'Kincardineshire',
        'Kinross',
        'Kirkcudbrightshire',
        'Lanarkshire',
        'Midlothian',
        'Morayshire',
        'Nairnshire',
        'Orkney',
        'Peeblesshire',
        'Perthshire',
        'Renfrewshire',
        'Ross-shire',
        'Roxburghshire',
        'Selkirkshire',
        'Shetland',
        'Stirlingshire',
        'Sutherland',
        'West Lothian',
        'Wigtownshire',
    ];

    public $northern_ireland = [
        'Antrim',
        'Armagh',
        'Down',
        'Fermanagh',
        'Londonderry',
        'Tyrone',
    ];


    public $UK_states = [
        "England", "Wales", "Scotland", "Northern Ireland"
    ];

    public function run()
    {
        foreach ($this->england as $state){
            DB::table('counties')->insert([
                'country_id' => 5,
                'state_id' => 52,
                'name' => $state,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }

        foreach ($this->wales as $state){
            DB::table('counties')->insert([
                'country_id' => 5,
                'state_id' => 53,
                'name' => $state,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }

        foreach ($this->scotland as $state){
            DB::table('counties')->insert([
                'country_id' => 5,
                'state_id' => 54,
                'name' => $state,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }

        foreach ($this->northern_ireland as $state){
            DB::table('counties')->insert([
                'country_id' => 5,
                'state_id' => 55,
                'name' => $state,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }


    }
}
