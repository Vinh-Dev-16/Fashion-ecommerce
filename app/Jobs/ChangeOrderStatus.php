<?php

namespace App\Jobs;

use App\Models\OrderDetail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ChangeOrderStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $orderDetail;
    public function __construct($orderDetail)
    {
        $this->orderDetail = $orderDetail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->orderDetail->update([
            'status' => 1,
            'time' => now(),
        ]);
    }
}
