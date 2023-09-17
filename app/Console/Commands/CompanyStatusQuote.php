<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\CompanyCreated;

class CompanyStatusQuote extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quote:daily {--data=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send emial after Disengage company';

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
        $data = json_decode($this->option('data'), true);
        // info($data['data']);
        foreach($data['data']['emails'] as $email){
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                Mail::to(trim($email))
                ->bcc('poterop744@larland.com')
                ->queue(new CompanyCreated($data['data']));
            }
        }

        return 0;
    }
}
