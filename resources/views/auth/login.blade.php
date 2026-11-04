<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>Masuk – KosAudit</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f8f9ff] font-['Inter'] text-[#0b1c30] min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8 space-y-6 border border-[#e5eeff]">
        {{-- Brand Header --}}
        <div class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-xl bg-[#0f766e] text-white flex items-center justify-center shadow-sm">
                <span class="material-symbols-outlined text-[26px]">verified_user</span>
            </div>
            <div>
                <h1 class="text-xl font-bold tracking-tight text-[#0b1c30]">KosAudit</h1>
                <p class="text-xs font-semibold uppercase tracking-wider text-[#6e7977]">Sistem Dokumentasi Kondisi &amp; Deposit Kos</p>
            </div>
        </div>

        <div>
            <h2 class="text-lg font-bold text-[#0b1c30]">Masuk ke Akun Anda</h2>
            <p class="text-sm text-[#3e4947] mt-0.5">Silakan masuk sebagai Pemilik Kos (Owner) atau Penghuni.</p>
        </div>

        {{-- Server-side Validation Error Display --}}
        @if ($errors->any())
            <div class="p-3.5 rounded-xl bg-[#ffdad6] text-[#ba1a1a] text-xs font-medium space-y-1">
                @foreach ($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        {{-- Login Form with CSRF & Role Selector --}}
        <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-[#3e4947] mb-1.5">Alamat Email</label>
                <input id="email"
                       name="email"
                       type="email"
                       value="{{ old('email', 'owner@kosaudit.test') }}"
                       required
                       class="w-full h-11 px-3.5 rounded-xl bg-[#eff4ff] text-sm text-[#0b1c30] focus:outline-none focus:ring-2 focus:ring-[#0f766e]"
                       placeholder="nama@email.com"/>
            </div>

            <div>
                <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-[#3e4947] mb-1.5">Kata Sandi</label>
                <input id="password"
                       name="password"
                       type="password"
                       required
                       class="w-full h-11 px-3.5 rounded-xl bg-[#eff4ff] text-sm text-[#0b1c30] focus:outline-none focus:ring-2 focus:ring-[#0f766e]"
                       placeholder="••••••••"/>
            </div>

            <div>
                <label for="role" class="block text-xs font-semibold uppercase tracking-wider text-[#3e4947] mb-1.5">Masuk Sebagai (Simulasi Role Flowchart)</label>
                <select id="role"
                        name="role"
                        class="w-full h-11 px-3.5 rounded-xl bg-[#eff4ff] text-sm text-[#0b1c30] focus:outline-none focus:ring-2 focus:ring-[#0f766e]">
                    <option value="owner">Owner / Pengelola Kos (Ke Dashboard Owner)</option>
                    <option value="tenant">Penghuni Kos (Ke Portal Penghuni)</option>
                </select>
            </div>

            <button type="submit"
                    class="w-full h-11 rounded-xl bg-[#0f766e] hover:bg-[#005c55] text-white font-semibold text-sm shadow-sm transition-all flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[18px]">login</span>
                <span>Masuk Sekarang</span>
            </button>
        </form>

        <p class="rounded-xl bg-[#eff4ff] p-3 text-xs text-[#3e4947]">
            Akun demo: <strong>owner@kosaudit.test</strong> atau
            <strong>tenant@kosaudit.test</strong> dengan password <strong>password</strong>.
        </p>

        <div class="pt-4 border-t border-[#e5eeff] flex items-center justify-between text-xs text-[#6e7977]">
            <span>Pintasan Prototipe:</span>
            <div class="flex gap-2">
                <a href="{{ route('dashboard') }}" class="text-[#0f766e] font-semibold hover:underline">Dashboard Owner</a>
                <span>•</span>
                <a href="{{ route('portal.dashboard') }}" class="text-[#0f766e] font-semibold hover:underline">Portal Penghuni</a>
            </div>
        </div>
    </div>
</body>
</html>