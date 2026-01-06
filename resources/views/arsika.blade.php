<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="ARSIKA Buleleng" />
    <meta name="google-site-verification" content="JTNsgh_fWNxtbuOEiTTb8Qkm-4k6-Ahjl2zn1p_tlws" />
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! JsonLd::generate() !!}


    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 sm:px-6 py-3 sm:py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2 sm:space-x-3">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-linear-to-br from-blue-600 to-blue-400 rounded-lg flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-base sm:text-xl font-bold text-gray-800">ARSIKA</h1>
                        <p class="text-xs text-gray-600 hidden sm:block">Buleleng</p>
                    </div>
                </div>

                <div>
                    @if (auth()->user())
                    <a href="{{ url('/logout') }}" class="bg-red-600 hover:bg-red-700 text-white px-4 sm:px-6 py-2 rounded-lg font-medium transition duration-300 flex items-center space-x-1 sm:space-x-2 text-sm sm:text-base">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        <span>Logout</span>
                    </a>
                    @else
                    <a href="{{ url('/login') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 sm:px-6 py-2 rounded-lg font-medium transition duration-300 flex items-center space-x-1 sm:space-x-2 text-sm sm:text-base">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        <span>Login</span>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <main>
        <div class="container mx-auto px-4 sm:px-6 py-8 sm:py-12 lg:py-16">
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                <!-- Content -->
                <article class="space-y-4 sm:space-y-6 flex flex-col justify-center">
                    <header class="text-center lg:text-left">
                        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-800 mb-2">ARSIKA</h2>
                        <h3 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-blue-600 mb-4 sm:mb-6">Buleleng</h3>
                    </header>

                    <p class="text-gray-600 text-base sm:text-lg leading-relaxed text-center lg:text-left">
                        Selamat Datang di Arsip Digital Kesbangpol Buleleng
                    </p>

                    <section class="bg-white p-4 sm:p-6 rounded-xl shadow-lg border border-gray-100">
                        <h4 class="font-semibold text-gray-800 mb-3 flex items-center justify-center lg:justify-start text-sm sm:text-base">
                            <svg class="w-5 h-5 text-blue-600 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Tentang Aplikasi
                        </h4>
                        <p class="text-gray-600 leading-relaxed text-sm sm:text-base text-center lg:text-left">
                            Aplikasi <strong class="font-semibold text-blue-600">ARSIKA Buleleng</strong> adalah sistem informasi yang dirancang untuk mengelola dan menyimpan data Arsip Kesbangpol Buleleng secara digital dan terstruktur.
                        </p>
                        <p class="text-gray-600 leading-relaxed mt-3 text-sm sm:text-base text-center lg:text-left">
                            Dilengkapi dengan fitur <strong class="font-semibold text-orange-600">Sinkronisasi dengan Google Drive</strong> yang digunakan untuk menyimpan file arsip yang di upload
                        </p>
                    </section>
                </article>

                <aside class="relative order-first lg:order-last flex justify-center lg:justify-end">
                    <div class="relative z-10">
                        <img src="{{ asset('img/arsika.png') }}" loading="lazy" alt="ARSIKA Buleleng - Sistem Arsip Digital Kesbangpol" class="w-80 h-auto drop-shadow-2xl" width="320" height="320" />
                    </div>
                    <div class="absolute top-10 right-10 w-16 h-16 sm:w-20 sm:h-20 bg-blue-200 rounded-full opacity-50 animate-pulse" aria-hidden="true"></div>
                    <div class="absolute bottom-10 left-10 w-12 h-12 sm:w-16 sm:h-16 bg-orange-200 rounded-full opacity-50 animate-pulse" style="animation-delay: 1s" aria-hidden="true"></div>
                </aside>
            </div>
        </div>

        <section class="bg-white py-12 sm:py-16">
            <div class="container mx-auto px-4 sm:px-6">
                <h2 class="text-2xl sm:text-3xl font-bold text-center text-gray-800 mb-8 sm:mb-12">Fitur Unggulan</h2>
                <div class="grid sm:grid-cols-2 lg:grid-cols-2 gap-6 sm:gap-8 max-w-4xl mx-auto">
                    <article class="text-center p-4 sm:p-6 rounded-xl hover:shadow-xl transition duration-300 border border-gray-100">
                        <div class="w-14 h-14 sm:w-16 sm:h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4" aria-hidden="true">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <h3 class="font-bold text-base sm:text-lg mb-2 text-gray-800">Database Terpusat</h3>
                        <p class="text-gray-600 text-sm sm:text-base">Semua data Arsip tersimpan dalam satu sistem</p>
                    </article>

                    <article class="text-center p-4 sm:p-6 rounded-xl hover:shadow-xl transition duration-300 border border-gray-100">
                        <div class="w-14 h-14 sm:w-16 sm:h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4" aria-hidden="true">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="font-bold text-base sm:text-lg mb-2 text-gray-800">Cetak Laporan Tahunan</h3>
                        <p class="text-gray-600 text-sm sm:text-base">Cetak laporan arsip tahunan dengan lebih mudah!</p>
                    </article>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-gray-800 text-white py-6 sm:py-8">
        <div class="container mx-auto px-4 sm:px-6 text-center">
            <p class="text-gray-400 text-xs sm:text-base">&copy; 2025 ARSIKA Buleleng. Prakom Kesbangpol</p>
        </div>
    </footer>
</body>

</html>