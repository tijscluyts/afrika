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
            background-size: cover; background-position: center; background-attachment: fixed;
        }
        .industrial-grid {
            background-image: linear-gradient(#e2e8f0 1px, transparent 1px), linear-gradient(90deg, #e2e8f0 1px, transparent 1px);
            background-size: 40px 40px;
        }
        [x-cloak] { display: none !important; }
        @keyframes scan-ltr { 0% { transform: translateX(-100%); } 100% { transform: translateX(1200%); } }
        .full-scanline { width: 120px; height: 100%; background: linear-gradient(to right, transparent, rgba(16, 185, 129, 0.1), transparent); animation: scan-ltr 6s linear infinite; }
    </style>
</head>
<body class="antialiased text-slate-900" x-data="{
    irrigationModal: false, automationModal: false, loading: false,
    autoIrrigation: true, minMoisture: 5, maxTemp: 40,
    startTime: '06:00', endTime: '22:00', startDate: '2026-03-17'
}">

<div x-show="automationModal" x-transition:enter="transition opacity duration-200" x-cloak class="fixed inset-0 z-[99998] flex items-center justify-center p-4 bg-slate-900/80 backdrop-blur-md">
    <div @click.away="automationModal = false" class="bg-white rounded-[2.5rem] max-w-2xl w-full overflow-hidden shadow-2xl border border-slate-200">
        <div class="bg-slate-900 p-8 text-white relative">
            <div class="absolute inset-0 opacity-20 industrial-grid"></div>
            <div class="relative z-10 flex justify-between items-center">
                <div>
                    <p class="text-[10px] font-black text-green-400 uppercase tracking-[0.3em]">System_Scheduler</p>
                    <h2 class="text-3xl font-black uppercase tracking-tighter italic">Automation Config</h2>
                </div>
                <button @click="automationModal = false" class="p-2 hover:bg-white/10 rounded-full transition-colors"><i data-lucide="x" class="w-6 h-6"></i></button>
            </div>
        </div>
        <div class="p-8 space-y-6 max-h-[75vh] overflow-y-auto">
            <div class="flex items-center justify-between p-5 bg-slate-900 text-white rounded-2xl shadow-inner">
                <div><p class="font-black text-sm uppercase tracking-widest text-green-400">Master Automation</p></div>
                <button @click="autoIrrigation = !autoIrrigation" :class="autoIrrigation ? 'bg-green-600' : 'bg-slate-700'" class="relative inline-flex h-7 w-14 items-center rounded-full transition-colors">
                    <span :class="autoIrrigation ? 'translate-x-7' : 'translate-x-1'" class="inline-block h-5 w-5 transform rounded-full bg-white transition-all shadow-md"></span>
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6" :class="!autoIrrigation && 'opacity-30 pointer-events-none'">
                <div class="md:col-span-2 space-y-4 pt-2 border-t border-slate-100">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="space-y-1">
                            <label class="text-[9px] font-bold text-slate-500 uppercase tracking-wider">Start Date</label>
                            <input type="date" x-model="startDate" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-mono text-xs outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[9px] font-bold text-slate-500 uppercase tracking-wider">Start Time</label>
                            <input type="time" x-model="startTime" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-mono text-xs outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[9px] font-bold text-slate-500 uppercase tracking-wider">End Time</label>
                            <input type="time" x-model="endTime" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-mono text-xs outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="flex justify-between"><label class="text-[9px] font-black uppercase text-slate-400 tracking-widest">Min. Moisture</label><span class="font-mono font-bold text-blue-600 text-sm" x-text="minMoisture + '%'"></span></div>
                    <input type="range" x-model="minMoisture" min="0" max="25" class="w-full h-1.5 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-blue-600 transition-all">
                </div>
                <div class="space-y-4">
                    <div class="flex justify-between"><label class="text-[9px] font-black uppercase text-slate-400 tracking-widest">Max. Temp</label><span class="font-mono font-bold text-red-600 text-sm" x-text="maxTemp + '°C'"></span></div>
                    <input type="range" x-model="maxTemp" min="30" max="55" class="w-full h-1.5 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-red-600 transition-all">
                </div>
            </div>
            <button @click="automationModal = false" class="w-full bg-green-700 text-white font-black py-4 rounded-2xl text-[10px] uppercase tracking-[0.2em] shadow-lg flex items-center justify-center gap-3 hover:bg-green-800 transition-all active:scale-95">
                <i data-lucide="save" class="w-4 h-4"></i>Sync Node Config
            </button>
        </div>
    </div>
</div>



<div x-show="irrigationModal" x-transition:enter="transition opacity duration-300" x-cloak class="fixed inset-0 z-[99999] flex items-center justify-center bg-slate-950/95 backdrop-blur-3xl">
    <div class="max-w-xl w-full border-2 border-green-500 bg-black p-12 shadow-[0_0_100px_rgba(16,185,129,0.5)] text-center font-mono">
        <template x-if="loading"><div class="space-y-8"><div class="w-20 h-20 border-4 border-green-500/20 border-t-green-500 rounded-full animate-spin mx-auto"></div><h2 class="text-2xl font-black uppercase text-green-500 animate-pulse">Secure_Link...</h2></div></template>
        <template x-if="!loading"><div class="space-y-8"><div class="bg-green-500 text-black w-20 h-20 flex items-center justify-center mx-auto rounded-full shadow-[0_0_40px_#10b981]"><i data-lucide="zap" class="w-10 h-10"></i></div><h2 class="text-4xl font-black text-white uppercase">Signal_Deployed</h2><button @click="irrigationModal = false" class="w-full border-2 border-green-500 text-green-500 py-4 uppercase text-xs font-black hover:bg-green-500 hover:text-black transition-all">Terminate Connection</button></div></template>
    </div>
</div>

<nav class="sticky top-0 z-50 px-8 py-4 flex justify-between items-center bg-white/90 backdrop-blur-md border-b border-slate-200 shadow-sm">
    <div class="flex items-center gap-2">
        <div class="bg-green-700 p-2 rounded-xl text-white shadow-lg"><i data-lucide="shield-check" class="w-6 h-6"></i></div>
        <span class="font-black text-xl tracking-tighter uppercase italic text-slate-800">Aggro<span class="text-green-700">Secure</span></span>
    </div>
    <a href="/" class="p-2 border border-red-100 rounded-lg text-red-500 hover:bg-red-500 hover:text-white transition-all"><i data-lucide="power" class="w-5 h-5"></i></a>
</nav>

<main class="p-6 max-w-7xl mx-auto space-y-8">
    <section class="relative bg-white rounded-[2rem] p-8 lg:p-12 shadow-2xl overflow-hidden border border-slate-200">
        <div class="absolute inset-0 opacity-40 industrial-grid"></div>
        <div class="absolute inset-x-0 top-0 full-scanline z-0 pointer-events-none"></div>
        <div class="relative z-10 w-full flex flex-col lg:flex-row items-center gap-12">
            <div class="relative group">
                <div class="w-64 h-64 lg:w-72 lg:h-72 bg-slate-100 rounded-lg p-1 border border-slate-200 overflow-hidden shadow-lg">
                    <img src="{{ asset($farmer['img']) }}" class="w-full h-full object-cover transition-all duration-700 rounded-sm">
                </div>
                <div class="absolute -bottom-2 -right-4 bg-green-700 text-white font-mono text-[10px] font-black px-3 py-1 uppercase tracking-tighter transform skew-x-12">NODE_ID: {{ $farmer['pico_id'] }}</div>
            </div>
            <div class="flex-1 space-y-8 text-center lg:text-left">
                <div>
                    <div class="flex items-center justify-center lg:justify-start gap-3 mb-2"><span class="h-1 w-12 bg-green-700"></span><span class="text-green-700 font-mono text-[10px] uppercase tracking-[0.4em] font-bold">Farmer Profile</span></div>
                    <h1 class="text-5xl lg:text-7xl font-black text-slate-900 tracking-tighter uppercase font-mono italic">{{ $farmer['name'] }}<span class="animate-pulse text-green-700">_</span></h1>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 py-6 border-y border-slate-100">
                    <div class="border-l-2 border-green-700/30 pl-4"><p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Region</p><p class="text-slate-800 font-bold text-sm uppercase tracking-wider">{{ $farmer['region'] }}</p></div>
                    <div class="border-l-2 border-green-700/30 pl-4"><p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Status</p><p class="text-green-700 font-bold text-sm uppercase font-mono tracking-tighter">Verified_Link</p></div>
                    <div class="border-l-2 border-green-700/30 pl-4"><p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Encryption</p><p class="text-slate-800 font-bold text-sm uppercase font-mono tracking-tighter">E2E_Secure</p></div>
                </div>
                <div class="flex flex-wrap justify-center lg:justify-start gap-3">
                    @foreach($farmer['crops'] as $crop)
                        <div class="bg-slate-50 border border-slate-200 px-4 py-2 flex items-center gap-3 group hover:bg-green-700 transition-colors">
                            <i data-lucide="leaf" class="text-green-700 w-5 h-5 group-hover:text-white transition-colors"></i>
                            <span class="text-[10px] font-black text-slate-600 uppercase group-hover:text-white tracking-widest">{{ $crop }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <div class="flex justify-center">
        <a href="/farm_map" class="group flex items-center gap-3 px-6 py-2.5 bg-slate-900 border border-slate-800 rounded-full text-white font-black text-[10px] uppercase tracking-[0.2em] hover:bg-green-700 hover:border-green-600 hover:shadow-[0_0_20px_rgba(21,128,61,0.4)] transition-all duration-300 active:scale-95">
            <i data-lucide="map" class="w-4 h-4 group-hover:animate-bounce"></i>
            <span>To Farm Map</span>
        </a>
    </div>

    <div class="space-y-4">
        @foreach($sensors as $sensor)
            <div x-data="{ open: false }" class="bg-white rounded-[2rem] border border-slate-200 shadow-lg overflow-hidden transition-all">
                <button @click="open = !open" class="w-full p-6 flex justify-between items-center hover:bg-slate-50 transition-colors">
                    <div class="flex items-center gap-6">
                        <div class="bg-slate-900 text-white w-14 h-14 rounded-2xl flex items-center justify-center shadow-lg"><span class="text-2xl font-black font-mono">{{ $sensor['display_id'] }}</span></div>
                        <div class="text-left"><p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Sensor Node {{ $sensor['id'] }}</p><h2 class="text-xl font-black uppercase tracking-tighter">{{ $sensor['name'] }}</h2></div>
                    </div>
                    <i data-lucide="chevron-down" class="transition-transform duration-500" :class="open ? 'rotate-180' : ''"></i>
                </button>

                <div x-show="open" x-collapse x-cloak>
                    <div class="p-8 pt-0 grid grid-cols-1 md:grid-cols-4 gap-6">

                        <div class="md:col-span-2 bg-slate-50 rounded-2xl p-8 border border-slate-100 flex flex-col justify-between shadow-inner">
                            @php
                                $moistureVal = intval($sensor['liveData']['moisture']);
                                $moistureCritical = ($moistureVal < 5 || $moistureVal > 75);
                                $mColor = $moistureCritical ? 'bg-red-500' : 'bg-blue-500';
                                $mText = $moistureCritical ? 'text-red-500' : 'text-blue-500';
                                $mPercent = max(0, min(100, $moistureVal));
                            @endphp
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Moisture</span>
                                <i data-lucide="droplets" class="w-8 h-8 {{ $mText }}"></i>
                            </div>
                            <h3 class="text-5xl font-black font-mono tracking-tighter {{ $moistureCritical ? 'text-red-600' : '' }}">{{ $sensor['liveData']['moisture'] }}</h3>
                            <div class="relative mt-8 mb-4">
                                <div class="absolute -top-3 -mt-1 flex flex-col items-center transition-all duration-1000" style="left: {{ $mPercent }}%; transform: translateX(-50%);">
                                    <div class="w-0 h-0 border-l-[6px] border-l-transparent border-r-[6px] border-r-transparent border-t-[8px] {{ $moistureCritical ? 'border-t-red-600' : 'border-t-blue-600' }}"></div>
                                </div>
                                <div class="relative h-3 w-full bg-slate-200 rounded-full overflow-hidden shadow-inner">
                                    <div class="{{ $mColor }} h-full transition-all duration-1000" style="width: {{ $mPercent }}%"></div>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4 mt-2">
                                <button @click="irrigationModal = true; loading = true; setTimeout(() => loading = false, 2500)" class="w-full bg-slate-900 text-white font-black py-3 rounded-xl text-[10px] uppercase tracking-widest hover:bg-black transition-all shadow-md active:scale-95">Trigger Water</button>
                                <button @click="automationModal = true" class="w-full border-2 border-slate-200 bg-white text-slate-600 font-black py-3 rounded-xl text-[10px] uppercase tracking-widest hover:bg-slate-50 transition-all shadow-sm active:scale-95">Automation Settings</button>
                            </div>
                        </div>

                        <div class="md:col-span-1 bg-slate-50 rounded-2xl p-6 border border-slate-100 flex flex-col justify-between shadow-inner">
                            @php
                                $tempVal = intval($sensor['liveData']['temp']);
                                $tempCritical = ($tempVal < 5 || $tempVal > 40);
                                $tColor = $tempCritical ? 'bg-red-500' : 'bg-green-500';
                                $tText = $tempCritical ? 'text-red-500' : 'text-green-600';
                                $tPercent = max(0, min(100, (($tempVal - (-15)) / (60 - (-15))) * 100));
                            @endphp
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Temperature</span>
                                <i data-lucide="thermometer-sun" class="w-8 h-8 {{ $tText }}"></i>
                            </div>
                            <h3 class="text-5xl font-black font-mono tracking-tighter {{ $tempCritical ? 'text-red-600' : '' }}">{{ $sensor['liveData']['temp'] }}°C</h3>
                            <div class="relative mt-8 mb-4">
                                <div class="absolute -top-3 -mt-1 flex flex-col items-center transition-all duration-1000" style="left: {{ $tPercent }}%; transform: translateX(-50%);">
                                    <div class="w-0 h-0 border-l-[6px] border-l-transparent border-r-[6px] border-r-transparent border-t-[8px] {{ $tempCritical ? 'border-t-red-600' : 'border-t-green-700' }}"></div>
                                </div>
                                <div class="relative h-3 w-full bg-slate-200 rounded-full overflow-hidden shadow-inner">
                                    <div class="{{ $tColor }} h-full transition-all duration-1000" style="width: {{ $tPercent }}%"></div>
                                </div>
                            </div>
                        </div>

                        <div class="md:col-span-1 bg-green-700 rounded-2xl p-6 flex flex-col justify-between text-white shadow-lg relative overflow-hidden">
                            <div class="absolute inset-0 opacity-10 industrial-grid"></div>
                            <div class="relative z-10 h-full flex flex-col justify-between">
                                <div class="flex justify-between items-center mb-4">
                                    <span class="text-[10px] font-black text-white/50 uppercase tracking-widest">Pico Power</span>
                                    <i data-lucide="battery-full" class="w-8 h-8 text-white"></i>
                                </div>
                                <h3 class="text-5xl font-black font-mono tracking-tighter text-white">{{ $sensor['liveData']['battery'] }}</h3>
                                <div class="flex items-center gap-2 mt-4"><div class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></div><span class="text-[9px] font-black uppercase tracking-widest text-green-400">Node_Online</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <footer class="mt-20 py-10 border-t border-slate-200 text-center">
        <p class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400">&copy; 2026 AgroCoders | Drought Response Africa</p>
    </footer>
</main>

<script>
    document.addEventListener('alpine:init', () => { lucide.createIcons(); });
    window.addEventListener('click', () => { setTimeout(() => lucide.createIcons(), 10); });
</script>
</body>
</html>
