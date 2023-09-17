<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Sales;

class ServiceProcess extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'proccess:service';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'background process that renews these services';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        info('ServiceProcess cron work aper');
        $Expired_Entries = Sales::where('periodical_one_off', '=', 1)
        ->where('Expired_Entrie', '=', null)
        ->where('until_date', '=', date('Y-m-d', strtotime('-1')).' 00:00:00')
        ->get();
        info($Expired_Entries);
        foreach($Expired_Entries as $Expired_Entrie){
            $Expired_Entrie->Expired_Entrie = 1;
            if($Expired_Entrie->save()){
                
                if($Expired_Entrie->until_date && $Expired_Entrie->for_periods){
                    $until_date = substr($Expired_Entrie->until_date ,0,10);
                    $start_date = substr($Expired_Entrie->start_date ,0,10);    

                    if(!empty($until_date) ){
                        $periods = [
                        'until_date' => [
                                'month' => date("Y-m-d", strtotime( $until_date ." +1 month +1 day")),
                                'year' => date("Y-m-d", strtotime( $until_date ." +1 year +1 day")),
                                'day' => date("Y-m-d", strtotime( $until_date ." +2 day")),
                                'week' => date("Y-m-d", strtotime( $until_date ." +1 week +1 day")),
                                'half_year' => date("Y-m-d", strtotime( $until_date ." +6 month +1 day")),
                                'quarter' => date("Y-m-d", strtotime( $until_date ." +3 month +1 day")),
                        ],
                        'start_date' => [
                                'month' => date("Y-m-d", strtotime( $start_date ." +1 month +1 day")),
                                'year' => date("Y-m-d", strtotime( $start_date ." +1 year +1 day")),
                                'day' => date("Y-m-d", strtotime( $start_date ." +2 day")),
                                'week' => date("Y-m-d", strtotime( $start_date ." +1 week +1 day")),
                                'half_year' => date("Y-m-d", strtotime( $start_date ." +6 month +1 day")),
                                'quarter' => date("Y-m-d", strtotime( $until_date ." +3 month +1 day")),
                            ],
                        ];
                     
                        if(!empty($periods['until_date'][$Expired_Entrie->for_periods])){
                            $Expired_Entrie->until_date = $periods['until_date'][$Expired_Entrie->for_periods]?$periods['until_date'][$Expired_Entrie->for_periods]. " 00:00:00" :null;
                        }

                        if(!empty($periods['start_date'][$Expired_Entrie->for_periods])){
                            $Expired_Entrie->start_date = $periods['start_date'][$Expired_Entrie->for_periods]?$periods['start_date'][$Expired_Entrie->for_periods]. " 00:00:00" :null;
                        }
                
                        $newExpired_Entries = new Sales();
                        
                        $newExpired_Entries->Expired_Entrie_id = $Expired_Entrie->id;
                        $newExpired_Entries->user_id = $Expired_Entrie->user_id;
                        $newExpired_Entries->account_id = $Expired_Entrie->account_id;
                        $newExpired_Entries->company_id = $Expired_Entrie->company_id;
                        $newExpired_Entries->quantity = $Expired_Entrie->quantity;
                        $newExpired_Entries->start_date = $Expired_Entrie->start_date;
                        $newExpired_Entries->until_date = $Expired_Entrie->until_date;
                        $newExpired_Entries->price_calculated = $Expired_Entrie->price_calculated;
                        $newExpired_Entries->for_periods = $Expired_Entrie->for_periods;
                        $newExpired_Entries->for_counts = $Expired_Entrie->for_counts;
                        $newExpired_Entries->currency = $Expired_Entrie->currency;
                        $newExpired_Entries->overall_price = $Expired_Entrie->overall_price;
                        $newExpired_Entries->price_per_period = $Expired_Entrie->price_per_period;
                        $newExpired_Entries->service_id = $Expired_Entrie->service_id;
                        $newExpired_Entries->set_price_time_spent = $Expired_Entrie->set_price_time_spent;
                        $newExpired_Entries->periodical_one_off = $Expired_Entrie->periodical_one_off;
                        $newExpired_Entries->renew_indefinitely_renew_until = $Expired_Entrie->renew_indefinitely_renew_until;
                        $newExpired_Entries->renew_until_periods = $Expired_Entrie->renew_until_periods;
                        $newExpired_Entries->comment = $Expired_Entrie->comment;

                        if($newExpired_Entries->save()){
                            info($newExpired_Entries->id);
                        }
                    }
                }
            }
        }
        return 0;
    }
}
