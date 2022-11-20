<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to users';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return Command::SUCCESS;
        $users = User::all();
        foreach($users as $user){
            $subject = "Test Email";
            $message = "Admin testing command email";
            $from_email = 'canwstech@gmail.com';
            $to = $user->email;
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: <'.$from_email.'>' . "\r\n";
            
            if(mail($to,$subject,$message,$headers)){
                return true;
            }else{
                echo 'wrong';
            }
        }
    }
}
