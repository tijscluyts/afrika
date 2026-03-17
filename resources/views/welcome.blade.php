<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AggroCoders | Smart Irrigation Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        /* Een subtle patroon voor de achtergrond, passend bij het thema */
        .bg-pattern {
            background-color: #fdf6e3; /* Warm beige */
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='4' height='4' viewBox='0 0 4 4'%3E%3Cpath fill='%3C3C7853%3E' fill-opacity='0.1' d='M1 3h1v1H1V3zm2-2h1v1H3V1z'%3E%3C/path%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="bg-pattern antialiased">

<nav class="bg-green-900 text-white p-5 shadow-xl border-b-4 border-orange-500">
    <div class="container mx-auto flex justify-between items-center">
        <a href="#" class="flex items-center gap-3">
            <span class="text-3xl font-bold tracking-tighter">AGGRO<span class="text-orange-400">CODERS</span></span>
            <span class="text-2xl">🌱</span>
        </a>
        <div class="flex items-center gap-6">

            <div class="bg-orange-500 text-green-950 font-bold px-4 py-1.5 rounded-full text-sm">
                Live Data Feed
            </div>
        </div>
    </div>
</nav>

<header class="py-12 bg-green-950 text-white">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-5xl font-extrabold tracking-tight">Smart Irrigation Control Center</h1>
        <p class="mt-4 text-xl text-gray-300 max-w-2xl mx-auto">
            Real-time monitoring and precision water management for Eastern Africa's sustainable future.
        </p>
    </div>
</header>

<main class="container mx-auto px-6 py-12">
    <div class="grid md:grid-cols-2 gap-10">
        @foreach($locations as $location)
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100 transition-all hover:shadow-orange-100 hover:-translate-y-1">

                <div class="relative h-56 bg-gray-200">
                    <img src="{{ $location['farmer_image'] }}" alt="{{ $location['farmer_name'] }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6 flex justify-between items-end text-white">
                        <div>
                            <p class="text-xs uppercase tracking-wider text-orange-200">{{ $location['region'] }}</p>
                            <h2 class="text-3xl font-bold">{{ $location['farmer_name'] }}</h2>
                            <p class="text-sm font-light opacity-90">{{ $location['farmer_field'] }}</p>
                        </div>
                        <span class="text-5xl">{{ $location['crop_icon'] }}</span>
                    </div>
                    <div class="absolute top-6 right-6 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest
                        {{ $location['status_color'] == 'green' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $location['status'] }}
                    </div>
                </div>

                <div class="p-8">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                        <span class="text-3xl">📊</span>
                        <h3 class="text-xl font-semibold text-gray-800">Field Telemetry</h3>
                    </div>

                    <div class="grid grid-cols-2 gap-x-8 gap-y-6">
                        @foreach($location['sensor_data'] as $data)
                            <div class="flex items-center gap-4 bg-gray-50 p-4 rounded-xl border border-gray-100">
                                <span class="text-2xl">{{ $data['icon'] }}</span>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wider">{{ $data['label'] }}</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ $data['value'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-gray-100 p-8 border-t border-gray-200">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
                        <div>
                            <p class="text-xs text-gray-600 uppercase">Irrigation System Status</p>
                            <p class="text-sm font-semibold text-green-900 mt-1">{{ $location['irrigation_system'] }}</p>
                        </div>

                        @if($location['id'] == 2)
                            <button class="bg-orange-500 text-white font-bold px-8 py-3 rounded-xl shadow-md hover:bg-orange-600 transition-colors flex items-center gap-2">
                                <span>💧</span>
                                Manual Water Override
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</main>

<footer class="bg-green-950 text-white py-10 mt-16 border-t-8 border-orange-500">
    <div class="container mx-auto px-6 text-center">
        <p class="text-xl font-semibold">AGGRO<span class="text-orange-400">CODERS</span></p>
        <p class="text-sm text-gray-400 mt-2">Thomas More ITF Project - Geel, Belgium</p>
    </div>
</footer>

</body>
</html>
