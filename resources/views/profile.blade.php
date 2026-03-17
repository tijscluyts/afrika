<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <title>AggroSecure | {{ $farmer['name'] }}</title>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-image: linear-gradient(rgba(241, 245, 249, 0.5), rgba(241, 245, 249, 0.5)), url('/99.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .industrial-grid {
            background-image: linear-gradient(#e2e8f0 1px, transparent 1px), linear-gradient(90deg, #e2e8f0 1px, transparent 1px);
            background-size: 40px 40px;
        }
        [x-cloak] { display: none !important; }

        .moisture-gradient {
            background: linear-gradient(90deg, #ef4444 0%, #facc15 15%, #3b82f6 60%, #10b981 100%);
        }

        /* Temperatuur gradiënt: Rood (5°C) -> Groen (Optimaal) -> Rood (40°C) */
        .temp-gradient {
            background: linear-gradient(90deg, #ef4444 0%, #10b981 50%, #ef4444 100%);
        }

        /* VERANDERDE ANIMATIE: Van links naar rechts */
        @keyframes scan-ltr {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(1200%); }
        }
        .full-scanline {
            width: 120px;
            height: 100%;
            background: linear-gradient(to right, transparent, rgba(16, 185, 129, 0.1), transparent);
            animation: scan-ltr 6s linear infinite;
        }
    </style>
</head>
<body class="antialiased text-slate-900" x-data="{ irrigationModal: false, loading: false }">

<nav class="sticky top-0 z-50 px-8 py-4 flex justify-between items-center bg-white/90 backdrop-blur-md border-b border-slate-200 shadow-sm">
    <div class="flex items-center gap-2">
        <div class="bg-green-700 p-2 rounded-xl text-white shadow-lg">
            <i data-lucide="shield-check" class="w-6 h-6"></i>
        </div>
        <span class="font-black text-xl tracking-tighter uppercase italic text-slate-800">Aggro<span class="text-green-700">Secure</span></span>
    </div>
    <div class="flex items-center gap-6">
        <div class="hidden md:flex flex-col items-end">
            <span class="text-[9px] font-black text-slate-400 uppercase leading-none">System Status</span>
            <span class="text-xs font-mono font-bold text-green-700 italic tracking-tighter">SECURE_LINK_ACTIVE</span>
        </div>
        <a href="/" class="p-2 border border-red-100 rounded-lg text-red-500 hover:bg-red-500 hover:text-white transition-all">
            <i data-lucide="power" class="w-5 h-5"></i>
        </a>
    </div>
</nav>

<main class="p-6 max-w-7xl mx-auto space-y-8">

    <section class="relative bg-white rounded-[2rem] p-8 lg:p-12 shadow-2xl overflow-hidden border border-slate-200">
        <div class="absolute inset-0 opacity-40 industrial-grid"></div>
        <div class="absolute inset-x-0 top-0 full-scanline z-0 pointer-events-none"></div>
        <div class="absolute top-4 left-4 w-8 h-8 border-t-2 border-l-2 border-green-700"></div>
        <div class="absolute top-4 right-4 w-8 h-8 border-t-2 border-r-2 border-green-700"></div>
        <div class="absolute bottom-4 left-4 w-8 h-8 border-b-2 border-l-2 border-green-700"></div>
        <div class="absolute bottom-4 right-4 w-8 h-8 border-b-2 border-r-2 border-green-700"></div>

        <div class="relative z-10 w-full flex flex-col lg:flex-row items-center gap-12">
            <div class="relative group">
                <div class="w-64 h-64 lg:w-72 lg:h-72 bg-slate-100 rounded-lg p-1 border border-slate-200 overflow-hidden shadow-lg">
                    <img src="{{ asset($farmer['img']) }}" class="w-full h-full object-cover transition-all duration-700 rounded-sm">
                </div>
                <div class="absolute -bottom-2 -right-4 bg-green-700 text-white font-mono text-[10px] font-black px-3 py-1 uppercase tracking-tighter transform skew-x-12">
                    NODE_ID: {{ $farmer['pico_id'] }}
                </div>
            </div>

            <div class="flex-1 space-y-8 text-center lg:text-left">
                <div>
                    <div class="flex items-center justify-center lg:justify-start gap-3 mb-2">
                        <span class="h-1 w-12 bg-green-700"></span>
                        <span class="text-green-700 font-mono text-[10px] uppercase tracking-[0.4em] font-bold">Farmer Profile</span>
                    </div>
                    <h1 class="text-5xl lg:text-7xl font-black text-slate-900 tracking-tighter uppercase font-mono italic">
                        {{ $farmer['name'] }}<span class="animate-pulse text-green-700">_</span>
                    </h1>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 py-6 border-y border-slate-100">
                    <div class="border-l-2 border-green-700/30 pl-4">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Region</p>
                        <p class="text-slate-800 font-bold text-sm uppercase tracking-wider">{{ $farmer['region'] }}</p>
                    </div>
                    <div class="border-l-2 border-green-700/30 pl-4">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Status</p>
                        <p class="text-green-700 font-bold text-sm uppercase font-mono tracking-tighter">Verified_Link</p>
                    </div>
                    <div class="border-l-2 border-green-700/30 pl-4">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Encryption</p>
                        <p class="text-slate-800 font-bold text-sm uppercase font-mono tracking-tighter">E2E_Secure</p>
                    </div>
                </div>

                <div class="flex flex-wrap justify-center lg:justify-start gap-3">
                    @foreach($farmer['crops'] as $crop)
                        <div class="bg-slate-50 border border-slate-200 px-4 py-2 flex items-center gap-3 group hover:bg-green-700 transition-colors">
                            @php
                                $icon = match(strtolower($crop)) {
                                    'wheat'     => 'wheat',
                                    'coffee'    => 'coffee',
                                    'cocoa'     => 'coffee',
                                    'sunflower' => 'flower',
                                    'grapes'    => 'grape',
                                    default     => 'leaf',
                                };
                            @endphp
                            <i data-lucide="{{ $icon }}" class="text-green-700 w-5 h-5 group-hover:text-white transition-colors"></i>
                            <span class="text-[10px] font-black text-slate-600 uppercase group-hover:text-white tracking-widest">{{ $crop }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <div class="flex justify-center">
        <!-- Explicitly using path to ensure ID is passed correctly -->
        <a href="/farm_map/{{ $farmer['id'] }}" class="group relative inline-flex items-center gap-3 bg-white border-2 border-slate-800 px-8 py-4 rounded-full font-black text-[11px] uppercase tracking-[0.3em] hover:bg-slate-800 hover:text-white transition-all shadow-xl">
            <i data-lucide="map-pin" class="w-4 h-4 text-green-700 group-hover:text-white"></i>
            To Farm Map
        </a>
    </div>

    <div class="space-y-4">
        @php
            $sensors = [
                ['name' => 'North', 'id' => '01', 'icon' => 'compass'],
                ['name' => 'South', 'id' => '02', 'icon' => 'navigation-2'],
                ['name' => 'Connector N-S', 'id' => '03', 'icon' => 'link-2']
            ];
        @endphp

        @foreach($sensors as $sensor)
            <div x-data="{ open: false }" class="bg-white rounded-[2rem] border border-slate-200 shadow-lg overflow-hidden transition-all">
                <button @click="open = !open" class="w-full p-6 flex justify-between items-center hover:bg-slate-50 transition-colors">
                    <div class="flex items-center gap-6">
                        <div class="bg-slate-900 text-white p-4 rounded-2xl">
                            <i data-lucide="{{ $sensor['icon'] }}" class="w-6 h-6"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Sensor Node {{ $sensor['id'] }}</p>
                            <h2 class="text-xl font-black uppercase tracking-tighter">{{ $sensor['name'] }}</h2>
                        </div>
                    </div>
                    <i data-lucide="chevron-down" class="transition-transform duration-500" :class="open ? 'rotate-180' : ''"></i>
                </button>

                <div x-show="open" x-collapse x-cloak>
                    <div class="p-8 pt-0 grid grid-cols-1 lg:grid-cols-3 gap-6">

                        <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100 flex flex-col justify-between">
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Moisture</span>
                                <i data-lucide="droplets" class="w-5 h-5 text-blue-500"></i>
                            </div>
                            <h3 class="text-5xl font-black font-mono">{{ $liveData['moisture'] }}</h3>
                            <div class="relative h-2 w-full bg-slate-200 rounded-full mt-4 overflow-hidden">
                                <div class="moisture-gradient h-full" style="width: {{ $liveData['moisture'] }}"></div>
                            </div>
                            <button @click="irrigationModal = true; loading = true; setTimeout(() => loading = false, 2500)"
                                    class="w-full mt-6 bg-green-700 text-white font-black py-3 rounded-xl text-[10px] uppercase tracking-widest hover:bg-green-800 transition-all">
                                Trigger Water
                            </button>
                        </div>

                        <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100 flex flex-col justify-between">
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Temperature</span>
                                <i data-lucide="thermometer-sun" class="w-5 h-5 text-orange-500"></i>
                            </div>
                            <h3 class="text-5xl font-black font-mono">{{ $liveData['temp'] }}</h3>
                            <div class="relative h-2 w-full bg-slate-200 rounded-full mt-4 overflow-hidden">
                                <div class="temp-gradient h-full" style="width: 70%"></div>
                            </div>
                            <div class="flex justify-between mt-2 font-black text-[8px] uppercase tracking-tighter">
                                <span class="text-red-500">5°C</span>
                                <span class="text-green-600">Optimum</span>
                                <span class="text-red-500">40°C</span>
                            </div>
                        </div>

                        <div class="bg-green-700 rounded-2xl p-6 flex flex-col justify-between text-white shadow-lg">
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-[10px] font-black text-white/50 uppercase tracking-widest">Pico Power</span>
                                <i data-lucide="battery-full" class="w-5 h-5 text-white"></i>
                            </div>
                            <h3 class="text-5xl font-black font-mono">{{ $liveData['battery'] }}</h3>
                            <div class="flex items-center gap-2 mt-4">
                                <div class="w-2 h-2 rounded-full bg-white animate-pulse"></div>
                                <span class="text-[9px] font-black uppercase tracking-widest">Link Active</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</main>

<div x-show="irrigationModal" x-cloak class="fixed inset-0 z-[9999] flex items-center justify-center p-4 bg-slate-900/90 backdrop-blur-xl text-green-500 font-mono">
    <div class="relative text-center max-w-md w-full border-2 border-green-500 bg-black p-12 shadow-[0_0_60px_rgba(16,185,129,0.3)]">
        <template x-if="loading">
            <div class="space-y-8 text-center">
                <div class="w-16 h-16 border-4 border-green-500/20 border-t-green-500 rounded-full animate-spin mx-auto"></div>
                <h2 class="text-xl font-black uppercase tracking-[0.2em] italic animate-pulse">Sending_Signal...</h2>
            </div>
        </template>
        <template x-if="!loading">
            <div class="space-y-8">
                <div class="bg-green-500 text-black w-16 h-16 flex items-center justify-center mx-auto rounded-full shadow-lg">
                    <i data-lucide="zap" class="w-8 h-8"></i>
                </div>
                <h2 class="text-3xl font-black uppercase tracking-tighter text-white">Signal_Deployed</h2>
                <button @click="irrigationModal = false" class="w-full border border-green-500 text-green-500 py-3 uppercase text-[10px] font-black tracking-[0.4em] hover:bg-green-500 hover:text-black transition-all">Close</button>
            </div>
        </template>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        lucide.createIcons();
    });
    lucide.createIcons();
</script>
</body>
</html>
