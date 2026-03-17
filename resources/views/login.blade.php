<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <title>AggroCoders | Secure Access</title>
</head>
<body class="bg-green-950 flex items-center justify-center h-screen font-['Poppins'] p-4">
<div class="bg-white p-8 md:p-12 rounded-[2rem] shadow-2xl w-full max-w-md border-b-[12px] border-orange-500">
    <div class="text-center mb-10">
        <span class="text-5xl">🌍</span>
        <h1 class="text-3xl font-black text-green-900 mt-4 uppercase tracking-tighter">AGGRO<span class="text-orange-500">CODERS</span></h1>
        <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mt-2 text-center">Farmer Access Portal</p>
    </div>

    <form action="/login" method="POST" class="space-y-6">
        @csrf
        <div>
            <label class="text-[10px] font-black uppercase text-gray-400 ml-2">Farmer ID / Email</label>
            <input type="text" name="email" required class="w-full p-4 bg-gray-100 rounded-2xl border-none focus:ring-2 focus:ring-green-500 outline-none mt-1" placeholder="bijv. samuel@aggro.test">
        </div>
        <div>
            <label class="text-[10px] font-black uppercase text-gray-400 ml-2">Security Code</label>
            <input type="password" name="password" required class="w-full p-4 bg-gray-100 rounded-2xl border-none focus:ring-2 focus:ring-green-500 outline-none mt-1" placeholder="••••••••">
        </div>
        <button type="submit" class="w-full bg-green-700 hover:bg-green-800 text-white font-black py-4 rounded-2xl transition-all shadow-lg uppercase tracking-widest">
            Unlock Dashboard
        </button>
    </form>
</div>
</body>
</html>
