@component('mail::message')
# Order Confirmation – Order #{{ $order->id }}

Thank you for your order!

**Items Ordered:**

@foreach ($order->items as $item)
- {{ $item->product->name }} × {{ $item->quantity }} — ${{ $item->price * $item->quantity }}
@endforeach

**Total:** ${{ $order->total_amount }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
