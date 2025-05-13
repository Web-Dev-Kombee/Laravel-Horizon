@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h2 class="text-4xl font-bold text-gray-800 mb-8 text-center">📦 Orders Dashboard</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($orders as $order)
            <div class="bg-white border border-gray-200 shadow-sm hover:shadow-md rounded-xl p-6 transition duration-300">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-xl font-semibold text-gray-700">Order #{{ $order->id }}</h3>
                    <span class="text-sm font-medium px-2 py-1 rounded-full
                        {{ $order->status === 'Completed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                <p class="text-gray-600 mb-2">💰 <strong>Total:</strong> ${{ number_format($order->total_amount, 2) }}</p>

                <ul class="list-disc pl-5 text-sm text-gray-600 space-y-1 mb-3">
                    @foreach ($order->items as $item)
                        <li>
                            {{ $item->product->name }} — 
                            <span class="font-medium">{{ $item->quantity }} × ${{ number_format($item->price, 2) }}</span>
                        </li>
                    @endforeach
                </ul>

                @if($order->invoice)
                    <div class="mt-4">
                        <a href="{{ asset($order->invoice->file_path) }}"
                           target="_blank"
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition">
                            📄 View Invoice
                        </a>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection
