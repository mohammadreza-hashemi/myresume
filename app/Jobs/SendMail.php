<?php

namespace App\Jobs;
use App\User;
use Carbon\Carbon;
use App\Mail\ActivationUserAccount;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

protected $user;
protected $code;
public $tries = 2;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user,$code)
    {
        $this->user= $user;
        $this->code= $code;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      \Mail::to($this->user)->send((new ActivationUserAccount($this->user,$this->code))->delay(Carbon::now()->addSeconds(60)));

    }
}
