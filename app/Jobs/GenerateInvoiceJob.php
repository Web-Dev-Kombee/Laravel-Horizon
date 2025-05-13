<?php

namespace App\Jobs;

use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

class GenerateInvoiceJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public function __construct(public Order $order) {}

    public function handle(): void
    {
        try {
            Log::info("Generating PDF for Order #{$this->order->id}");

            // Generate PDF
            $pdf = Pdf::loadView('pdf.invoice', ['order' => $this->order]);

            // Define public path for saving
            $directory = public_path('invoices');
            $fileName = "order_{$this->order->id}.pdf";
            $filePath = $directory . '/' . $fileName;

            // Ensure folder exists
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
            }

            // Save PDF file
            file_put_contents($filePath, $pdf->output());

            // Save invoice info to DB (optional)
            Invoice::create([
                'order_id' => $this->order->id,
                'file_path' => "invoices/{$fileName}",
            ]);

            Log::info("Invoice PDF saved to: {$filePath}");
        } catch (\Throwable $e) {
            Log::error("Failed to generate invoice PDF: " . $e->getMessage());
        }
    }
}
