<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AggroCoders | Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-orange-50 font-sans">

<nav class="bg-green-800 text-white p-6 shadow-lg">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-3xl font-bold tracking-tighter">AGGRO<span class="text-orange-400">CODERS</span></h1>
        <p class="italic text-sm">Empowering Eastern Africa's Farmers</p>
    </div>
</nav>

<header class="py-12 text-center">
    <h2 class="text-4xl font-extrabold text-green-900">Smart Irrigation Dashboard</h2>
    <p class="text-gray-600 mt-2">Live monitoring for the Rift Valley & Arusha regions.</p>
</header>

<main class="container mx-auto px-4 pb-12">
    <div class="grid md:grid-cols-2 gap-8">
        @foreach($locations as $location)
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border-t-8 {{ $location['color'] == 'green' ? 'border-green-500' : 'border-red-500' }}">
                <div class="p-8">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800">{{ $location['name'] }}</h3>
                            <p class="text-green-700 font-medium">{{ $location['region'] }}</p>
                        </div>
                        <span class="px-4 py-1 rounded-full text-sm font-bold {{ $location['color'] == 'green' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $location['status'] }}
                        </span>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mt-8">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-gray-500 text-sm uppercase">Humidity</p>
                            <p class="text-3xl font-bold text-gray-800">{{ $location['humidity'] }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-gray-500 text-sm uppercase">Temperature</p>
                            <p class="text-3xl font-bold text-gray-800">{{ $location['temp'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-100 p-4 text-center">
                    <button class="text-green-800 font-bold hover:underline">View Detailed Analytics →</button>
                </div>
            </div>
        @endforeach
    </div>
</main>

</body>
</html>
