<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AggroCoders | Farm Map</title>
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            /* Use asset helper for correct path resolution */
            background-image: linear-gradient(rgba(241, 245, 249, 0.5), rgba(241, 245, 249, 0.5)), url('{{ asset('99.jpg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .industrial-grid {
            background-image: linear-gradient(#e2e8f0 1px, transparent 1px), linear-gradient(90deg, #e2e8f0 1px, transparent 1px);
            background-size: 40px 40px;
        }

        [x-cloak] {
            display: none !important;
        }

        .moisture-gradient {
            background: linear-gradient(90deg, #ef4444 0%, #facc15 15%, #3b82f6 60%, #10b981 100%);
        }

        /* Temperatuur gradiënt: Rood (5°C) -> Groen (Optimaal) -> Rood (40°C) */
        .temp-gradient {
            background: linear-gradient(90deg, #ef4444 0%, #10b981 50%, #ef4444 100%);
        }

        /* VERANDERDE ANIMATIE: Van links naar rechts */
        @keyframes scan-ltr {
            0% {
                transform: translateX(-100%);
            }
            100% {
                transform: translateX(1200%);
            }
        }

        .full-scanline {
            width: 120px;
            height: 100%;
            background: linear-gradient(to right, transparent, rgba(16, 185, 129, 0.1), transparent);
            animation: scan-ltr 6s linear infinite;
        }

        .farm-bg {
            /* Fallback or secondary background if needed */
            background-image: url('https://images.unsplash.com/photo-1500382017468-9049fed747ef?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="bg-stone-100 font-sans h-screen flex flex-col">

<nav
    class="sticky top-0 z-50 px-8 py-4 flex justify-between items-center bg-white/90 backdrop-blur-md border-b border-slate-200 shadow-sm">
    <div class="flex items-center gap-2">
        <a href="{{ $id ? route('profile', ['id' => $id]) : '/' }}" class="flex items-center gap-2 hover:opacity-80 transition-opacity">
            <div class="bg-green-700 p-2 rounded-xl text-white shadow-lg">
                <i data-lucide="shield-check" class="w-6 h-6"></i>
            </div>
            <span class="font-black text-xl tracking-tighter uppercase italic text-slate-800">Aggro<span
                    class="text-green-700">Secure</span></span>
        </a>
    </div>
    <div class="flex items-center gap-6">
        <div class="hidden md:flex flex-col items-end">
            <span class="text-[9px] font-black text-slate-400 uppercase leading-none">System Status</span>
            <span class="text-xs font-mono font-bold text-green-700 italic tracking-tighter">SECURE_LINK_ACTIVE</span>
        </div>
        <a href="/"
           class="p-2 border border-red-100 rounded-lg text-red-500 hover:bg-red-500 hover:text-white transition-all">
            <i data-lucide="power" class="w-5 h-5"></i>
        </a>
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
                    <x-humidity-card location="Maize Field (North)" mode="map"/>
                </div>
            </div>

            <!-- Zone 2: Smaller Patch -->
            <div class="md:col-span-1 md:row-span-1">
                <div class="h-full w-full">
                    <x-humidity-card location="Vegetable Patch" mode="map"/>
                </div>
            </div>

            <!-- Zone 3: Smaller Patch -->
            <div class="md:col-span-1 md:row-span-1">
                <div class="h-full w-full">
                    <x-humidity-card location="Orchard (East)" mode="map"/>
                </div>
            </div>

        </div>
    </main>
</div>
<script>
    lucide.createIcons();
</script>
</body>
</html>
