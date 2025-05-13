<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationMail;




class SendOrderConfirmationJob implements ShouldQueue
{
    use Dispatchable, Queueable;
    
    public function __construct(public Order $order) {}
    
    public function handle(): void
    {
        $order = Order::find($this->order->id); // Re-fetch full model

    if (!$order || empty($order->email)) {
        Log::error("[SendOrderConfirmationJob] Order not found or missing email.");
        return;
    }

    Log::info("[SendOrderConfirmationJob] Sending email to: " . $order->email);

    Mail::to($order->email)->send(new OrderConfirmationMail($order));

    Log::info("[SendOrderConfirmationJob] Confirmation sent for order #{$order->id}");
    }
}
