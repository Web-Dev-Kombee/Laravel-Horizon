@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-8 bg-white shadow-lg rounded-lg my-8">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">Place Your Order</h2>
    
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md">
            <div class="flex">
                <div class="flex-shrink-0">
                    <!-- Heroicon check circle -->
                    <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif
    
    <form action="{{ route('order.store') }}" method="POST">
        @csrf
        
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-semibold mb-2" for="email">
                Email Address
            </label>
            <input type="email" 
                   name="email" 
                   id="email" 
                   required 
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150"
                   placeholder="your@email.com">
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="bg-gray-50 rounded-md p-4 mb-6">
            <h3 class="text-lg font-medium text-gray-700 mb-4">Select Products</h3>
            
            <div class="space-y-4">
                @foreach($products as $product)
                    <div class="flex items-center justify-between p-3 bg-white rounded-md shadow-sm border border-gray-100 hover:border-gray-200 transition-all">
                        <div>
                            <p class="font-medium text-gray-800">{{ $product->name }}</p>
                            <p class="text-sm text-gray-600">${{ number_format($product->price, 2) }}</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <label for="quantity-{{ $product->id }}" class="text-sm text-gray-500">Qty:</label>
                            <input type="number" 
                                   name="products[{{ $loop->index }}][quantity]"
                                   id="quantity-{{ $product->id }}"
                                   class="border border-gray-300 rounded-md px-3 py-1 w-20 focus:outline-none focus:ring-1 focus:ring-blue-500"
                                   placeholder="0" 
                                   min="0">
                            <input type="hidden" name="products[{{ $loop->index }}][id]" value="{{ $product->id }}">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
        <div class="flex justify-end">
            <button type="submit"
                    class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-colors duration-200 font-medium">
                Complete Order
            </button>
        </div>
    </form>
</div>
@endsection