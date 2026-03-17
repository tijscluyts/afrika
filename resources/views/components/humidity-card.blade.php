@props(['location' => 'Unknown Location', 'mode' => 'card'])

@php
    // Random humidity between 0 and 100
    $humidity = rand(0, 100);

    // Determine color and status based on humidity
    if ($humidity < 30) {
        $theme = 'red';
        $status = 'Critical Dry';
    } elseif ($humidity < 50) {
        $theme = 'orange';
        $status = 'Low Moisture';
    } elseif ($humidity > 80) {
        $theme = 'blue';
        $status = 'Oversaturated';
    } else {
        $theme = 'green';
        $status = 'Optimal';
    }

    $classes = match($theme) {
        'red' => [
            'card' => 'bg-red-50 border-red-500',
            'text' => 'text-red-900',
            'subtext' => 'text-red-700',
            'badge' => 'bg-red-200 text-red-800',
            'map' => 'bg-red-600'
        ],
        'orange' => [
            'card' => 'bg-orange-50 border-orange-500',
            'text' => 'text-orange-900',
            'subtext' => 'text-orange-700',
            'badge' => 'bg-orange-200 text-orange-800',
            'map' => 'bg-orange-500'
        ],
        'blue' => [
            'card' => 'bg-blue-50 border-blue-500',
            'text' => 'text-blue-900',
            'subtext' => 'text-blue-700',
            'badge' => 'bg-blue-200 text-blue-800',
            'map' => 'bg-blue-600'
        ],
        'green' => [
            'card' => 'bg-green-50 border-green-500',
            'text' => 'text-green-900',
            'subtext' => 'text-green-700',
            'badge' => 'bg-green-200 text-green-800',
            'map' => 'bg-green-600'
        ],
    };
@endphp

@if($mode === 'map')
    <div class="{{ $classes['map'] }} bg-opacity-60 hover:bg-opacity-80 backdrop-blur-sm transition-all duration-500 flex flex-col justify-center items-center h-full min-h-[200px] border-2 border-white/30 rounded-lg group relative overflow-hidden">
        <!-- Background pulse effect for critical status -->
        @if($theme === 'red')
            <div class="absolute inset-0 bg-red-500 opacity-20 animate-pulse"></div>
        @endif

        <div class="relative z-10 text-center text-white drop-shadow-md">
            <h3 class="font-bold text-xl uppercase tracking-widest mb-1">{{ $location }}</h3>
            <div class="text-5xl font-black mb-2">{{ $humidity }}<span class="text-2xl font-medium">%</span></div>
            <span class="bg-black/30 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide border border-white/20">
                {{ $status }}
            </span>
        </div>

        <!-- Hover details -->
        <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
             <button class="bg-white text-gray-800 px-4 py-2 rounded-full font-bold text-sm shadow-lg transform translate-y-4 group-hover:translate-y-0 transition duration-300">
                View Sensor Data
            </button>
        </div>
    </div>
@else
    <div class="rounded-xl shadow-md border-l-4 p-5 {{ $classes['card'] }} transition transform hover:scale-105 duration-300 bg-white">
        <div class="flex justify-between items-start mb-4">
            <h3 class="font-bold text-lg {{ $classes['text'] }}">{{ $location }}</h3>
            <span class="text-xs font-bold px-2 py-1 rounded-full uppercase tracking-wide {{ $classes['badge'] }}">
                {{ $status }}
            </span>
        </div>

        <div class="flex items-baseline">
            <span class="text-4xl font-extrabold {{ $classes['text'] }}">{{ $humidity }}%</span>
            <span class="ml-2 text-sm font-medium {{ $classes['subtext'] }}">Humidity</span>
        </div>

        <div class="mt-4 w-full bg-white bg-opacity-40 rounded-full h-2">
            <div class="h-2 rounded-full {{ str_replace('text-', 'bg-', $classes['subtext']) }}" style="width: {{ $humidity }}%"></div>
        </div>
    </div>
@endif
