<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Order $order) {}

    public function build()
    {
        $invoicePath = public_path("invoices/order_{$this->order->id}.pdf");

        return $this->subject("Order #{$this->order->id} Confirmation")
                    ->markdown('emails.order.confirmation', ['order' => $this->order])
                    ->attach($invoicePath, [
                        'as' => "invoice_{$this->order->id}.pdf",
                        'mime' => 'application/pdf',
                    ]);
        
            }
}
