<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AggroCoders | Farm Map</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .farm-bg {
            background-image: url('https://images.unsplash.com/photo-1500382017468-9049fed747ef?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="bg-stone-100 font-sans h-screen flex flex-col">

<nav class="bg-green-800 text-white p-4 shadow-lg z-50">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-2xl font-bold tracking-tighter">AGGRO<span class="text-orange-400">CODERS</span></h1>
        <div class="flex space-x-4 text-sm">
            <a href="/" class="hover:text-orange-300 transition">Dashboard</a>
            <a href="/farm-map" class="text-orange-400 font-bold border-b-2 border-orange-400">Live Map</a>
        </div>
    </div>
</nav>

<div class="flex-grow flex flex-col relative farm-bg">
    <!-- Overlay for better text readability -->
    <div class="absolute inset-0 bg-black bg-opacity-30 pointer-events-none"></div>

    <header class="relative z-10 py-6 px-8 text-white">
        <h2 class="text-4xl font-extrabold text-shadow-md">Rift Valley Farm Sector A</h2>
        <div class="flex items-center gap-4 mt-2">
            <span class="bg-black/50 px-3 py-1 rounded text-sm backdrop-blur-sm">Updates live every 5s</span>
            <div class="flex gap-3 text-xs font-bold">
                <span class="text-red-300">< 30% Critical</span>
                <span class="text-orange-300">30-50% Low</span>
                <span class="text-green-300">50-80% Optimal</span>
                <span class="text-blue-300">> 80% High</span>
            </div>
        </div>
    </header>

    <main class="relative z-10 flex-grow p-8 container mx-auto">
        <!-- Asymmetrical Map Grid for 3 Zones -->
        <div class="grid grid-cols-1 md:grid-cols-3 md:grid-rows-2 gap-4 h-full min-h-[500px]">

            <!-- Zone 1: Main Field (Large area) -->
            <div class="md:col-span-2 md:row-span-2">
                <div class="h-full w-full">
                    <x-humidity-card location="Maize Field (North)" mode="map" />
                </div>
            </div>

            <!-- Zone 2: Smaller Patch -->
            <div class="md:col-span-1 md:row-span-1">
                 <div class="h-full w-full">
                    <x-humidity-card location="Vegetable Patch" mode="map" />
                 </div>
            </div>

            <!-- Zone 3: Smaller Patch -->
            <div class="md:col-span-1 md:row-span-1">
                 <div class="h-full w-full">
                    <x-humidity-card location="Orchard (East)" mode="map" />
                 </div>
            </div>

        </div>
    </main>
</div>

</body>
</html>
