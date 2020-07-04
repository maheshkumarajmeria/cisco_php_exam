<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\CiscoRouterModel;

class AddRouterDetails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'router:details {no_of_rows}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        ;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $no_of_rows           = $this->argument('no_of_rows');
        if(is_numeric($no_of_rows) && $no_of_rows>0){
            for($i=0;$i<$no_of_rows;$i++){
                 $RouterObj = new CiscoRouterModel;
                 $RouterObj->Sapid = $this->generateRandomString(18); 
                 $RouterObj->Hostname = $this->generateRandomString(14); 
                 $RouterObj->LoopBack = "".mt_rand(0,255).".".mt_rand(0,255).".".mt_rand(0,255).".".mt_rand(0,255);
                 $RouterObj->Mac_Address = implode(':', str_split(substr(md5(mt_rand()), 0, 12), 2));
                 $RouterObj->save();

            }
        }

    }
    public function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
    }
}
