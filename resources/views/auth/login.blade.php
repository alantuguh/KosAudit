<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Masuk | KosAudit</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen overflow-x-hidden antialiased">

    <!-- Scene: background foto + overlay dari foundation, dipaksa tema dark -->
    <div
        class="ui-app-background"
        data-theme="dark"
        style="--app-background-image: url('{{ asset('images/bg_sudut.jpg') }}');">
        <main class="flex min-h-screen items-center justify-center px-5 py-10 lg:justify-between lg:gap-16 lg:px-[9%] xl:px-[11%]">

            <!-- Login -->
            <section class="w-full max-w-[420px]">
                <x-glass-card level="premium" class="p-6 sm:p-8">

                    <header class="mb-7 space-y-2">
                        <h1 class="ui-heading-lg">Selamat Datang</h1>
                        <p class="ui-body-sm">
                            Masuk ke akun Anda untuk melanjutkan pengelolaan kondisi kamar dan deposit.
                        </p>
                    </header>

                    <x-glass-alert :except="['email', 'password']" />

                    <form method="POST" action="{{ route('login') }}" class="space-y-5">
                        @csrf

                        <x-glass-input
                            label="Alamat Email"
                            type="email"
                            id="email"
                            name="email"
                            :value="old('email')"
                            required
                            autofocus
                            autocomplete="username"
                            icon="mail"
                            placeholder="nama@email.com" />

                        <x-glass-input
                            label="Kata Sandi"
                            type="password"
                            id="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            icon="lock"
                            placeholder="Masukkan kata sandi" />

                        <x-glass-checkbox name="remember" value="1" label="Ingat saya" />

                        <x-glass-button type="submit" variant="secondary">
                            Masuk ke Akun
                        </x-glass-button>
                    </form>

                    <div class="ui-glass-divider mt-6"></div>

                    <p class="ui-caption mt-4 text-center">
                        &copy; {{ date('Y') }} KosAudit. All rights reserved.
                    </p>

                </x-glass-card>
            </section>

            <!-- Right introduction -->
            <section class="hidden w-full max-w-[510px] lg:block">

                <x-glass-card level="subtle" radius="control" class="mb-7 inline-flex items-center gap-3 px-4 py-3">
                    <span class="material-symbols-outlined text-brand-300" aria-hidden="true">
                        apartment
                    </span>
                    <span class="ui-eyebrow">Room Condition Management</span>
                </x-glass-card>

                <h2 class="ui-heading-xl max-w-[500px]">
                    Transparansi Kondisi Kamar,
                    <span class="text-brand-300">Keamanan Deposit.</span>
                </h2>

                <p class="ui-body mt-5 max-w-[430px]">
                    Dokumentasikan kondisi fisik kamar, pantau perubahan fasilitas, dan kelola deposit secara lebih transparan, cepat, serta adil bagi pemilik maupun penghuni kos.
                </p>

            </section>

        </main>
    </div>

</body>

</html>