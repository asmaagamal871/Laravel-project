<?php

namespace App\Jobs;

use App\Models\Address;
use App\Models\Order;
use App\Models\Pharmacy;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AssignOrderJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $orders=Order::where('status', 'new')->get();
        foreach ($orders as $order) {
            $order->pharmacy_id=Pharmacy::where('area_id', Address::find($order->address_id)->area_id)
            ->orderby('priority', 'desc')
            ->first()
            ->id;
            $order->status='processing';
            $order->save();
        }
    }
}
