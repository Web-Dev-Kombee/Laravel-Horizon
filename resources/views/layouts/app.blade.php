<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>QuickCart Order Processor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen font-sans leading-normal tracking-wide">

    <nav class="bg-white shadow mb-6">
        <div class="max-w-6xl mx-auto px-4 py-3 flex justify-between items-center">
            <a href="/" class="text-lg font-semibold text-gray-800">QuickCart</a>
            <a href="/order" class="text-sm text-blue-600 hover:underline">Place Order</a>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-4">
        @yield('content')
    </main>

</body>
</html>
