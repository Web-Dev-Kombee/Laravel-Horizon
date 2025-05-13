<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Jobs\DeductInventoryJob;
use App\Jobs\GenerateInvoiceJob;
use App\Jobs\SendOrderConfirmationJob;

class OrderController extends Controller
{
    public function create()
    {
        $products = Product::all();
        return view('order.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        $items = collect($request->input('products'))->filter(fn($item) => $item['quantity'] > 0);

        $total = 0;
        foreach ($items as $item) {
            $product = Product::find($item['id']);
            $total += $product->price * $item['quantity'];
        }

        $order = Order::create([
            'user_id' => null,
            'email' => $request->input('email'),
            'total_amount' => $total,
            'status' => 'pending',
        ]);

        foreach ($items as $item) {
            $product = Product::find($item['id']);
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'price' => $product->price,
            ]);
        }

        // Dispatch the job chain (next step)
        // dispatch(new DeductInventoryJob($order))->chain([...]);
        DeductInventoryJob::withChain([
            new GenerateInvoiceJob($order),
            new SendOrderConfirmationJob($order),
        ])->dispatch($order);
        return redirect()->route('order.create')->with('success', 'Order placed successfully!');
    }

    public function dashboard()
{
    $orders = Order::with(['items.product', 'invoice'])->latest()->get();
    return view('dashboard.index', compact('orders'));
}

}

