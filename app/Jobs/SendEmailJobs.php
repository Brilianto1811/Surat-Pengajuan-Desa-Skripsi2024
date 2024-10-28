<?php

namespace App\Jobs;

use App\Mail\RegisterMail;
use App\Mail\SendEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJobs implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     *
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        switch ($this->data['jenis']) {
            case 1:
                $mail = new RegisterMail($this->data);
                break;
            case 2:
                $mail = new SendEmail($this->data);
                break;
            default:
                # code...
                break;
        }
        // Mail::to($this->data['email'])->send($mail);
        Mail::to($this->data['akun'])->send($mail);
    }
}
