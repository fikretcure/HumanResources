<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class UserStoreMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public array $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $data)
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
        $data = [
            "name" => str()->title($this->data["name"]) . " " . str()->title($this->data["surname"]),
            "email" => $this->data["email"],
            "token" => $this->data["token"]
        ];


        mail::send("mail.userStoreMailJob", $data, function ($message) {
            $message->subject("Sayın " . str()->title($this->data["name"]) . " " . str()->title($this->data["surname"]) . " Hesabınız Oluşturuldu");
            $message->to($this->data["email"]);
        });
    }
}
