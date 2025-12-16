<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="Validasi Arsip - ARSIKA Buleleng" />
    <title>Validasi Arsip - ARSIKA Buleleng</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 sm:px-6 py-3 sm:py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2 sm:space-x-3">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-blue-600 to-blue-400 rounded-lg flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-base sm:text-xl font-bold text-gray-800">ARSIKA</h1>
                        <p class="text-xs text-gray-600 hidden sm:block">Buleleng</p>
                    </div>
                </div>

            </div>
        </div>
    </nav>

    <main>
        <div class="container mx-auto px-4 sm:px-6 py-8 sm:py-12 lg:py-16">
            @if($valid)
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-2xl shadow-xl p-6 sm:p-8 mb-6 text-center border-t-4 border-green-500">
                    <div class="mb-4">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto">
                            <svg class="w-12 h-12 sm:w-14 sm:h-14 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2">Arsip Valid!</h2>
                    <p class="text-gray-600 text-sm sm:text-base">
                        Dokumen ini merupakan arsip resmi <strong class="text-blue-600">Kesbangpol Buleleng</strong> yang tersimpan dalam sistem<br class="hidden sm:block">
                        <strong class="text-blue-600">ARSIKA Buleleng</strong>
                    </p>
                </div>

                <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-6">
                    <div class="bg-gradient-to-r from-blue-600 to-blue-400 px-6 py-4">
                        <h3 class="text-white font-bold text-lg sm:text-xl flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Informasi Arsip
                        </h3>
                    </div>
                    <div class="p-6 sm:p-8">
                        <div class="grid gap-4">
                            <div class="flex flex-col sm:flex-row sm:items-center border-b border-gray-100 pb-4">
                                <div class="font-semibold text-gray-700 mb-1 sm:mb-0 sm:w-48 text-sm sm:text-base">Kode Arsip</div>
                                <div class="text-gray-900 font-medium text-sm sm:text-base">{{ $arsip->kode_arsip }}</div>
                            </div>

                            <div class="flex flex-col sm:flex-row sm:items-center border-b border-gray-100 pb-4">
                                <div class="font-semibold text-gray-700 mb-1 sm:mb-0 sm:w-48 text-sm sm:text-base">Nama File</div>
                                <div class="text-gray-900 text-sm sm:text-base break-all">{{ $arsip->nama_file }}</div>
                            </div>

                            <div class="flex flex-col sm:flex-row sm:items-center border-b border-gray-100 pb-4">
                                <div class="font-semibold text-gray-700 mb-1 sm:mb-0 sm:w-48 text-sm sm:text-base">Kategori</div>
                                <div class="text-gray-900 text-sm sm:text-base">{{ $arsip->kategori }}</div>
                            </div>

                            <div class="flex flex-col sm:flex-row sm:items-center border-b border-gray-100 pb-4">
                                <div class="font-semibold text-gray-700 mb-1 sm:mb-0 sm:w-48 text-sm sm:text-base">Tanggal Arsip</div>
                                <div class="text-gray-900 text-sm sm:text-base">{{ \Carbon\Carbon::parse($arsip->tanggal_arsip)->format('d F Y') }}</div>
                            </div>

                            <div class="flex flex-col sm:flex-row sm:items-center border-b border-gray-100 pb-4">
                                <div class="font-semibold text-gray-700 mb-1 sm:mb-0 sm:w-48 text-sm sm:text-base">Bidang</div>
                                <div class="text-gray-900 text-sm sm:text-base">{{ $arsip->user->bidang->nama_bidang ?? '-' }}</div>
                            </div>

                            <div class="flex flex-col sm:flex-row sm:items-center border-b border-gray-100 pb-4">
                                <div class="font-semibold text-gray-700 mb-1 sm:mb-0 sm:w-48 text-sm sm:text-base">Klasifikasi</div>
                                <div class="text-gray-900 text-sm sm:text-base">{{ $arsip->kodeKlasifikasi->kode ?? '-' }}</div>
                            </div>

                            <div class="flex flex-col sm:flex-row sm:items-center border-b border-gray-100 pb-4">
                                <div class="font-semibold text-gray-700 mb-1 sm:mb-0 sm:w-48 text-sm sm:text-base">Status Legalisasi</div>
                                <div>
                                    @if($arsip->status_legalisasi == 'legal')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                        Legal
                                    </span>
                                    @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                        </svg>
                                        On Progress
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row sm:items-center">
                                <div class="font-semibold text-gray-700 mb-1 sm:mb-0 sm:w-48 text-sm sm:text-base">Diupload Oleh</div>
                                <div class="text-gray-900 text-sm sm:text-base">{{ $arsip->user->name ?? '-' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <a href="{{ route('home.arsip.show', $arsip->id) }}?v={{ $arsip->updated_at->timestamp }}"
                        target="_blank"
                        class="inline-flex items-center justify-center bg-gradient-to-r from-blue-600 to-blue-400 hover:from-blue-700 hover:to-blue-500 text-white px-8 py-3 sm:px-10 sm:py-4 rounded-xl font-semibold transition duration-300 shadow-lg hover:shadow-xl text-sm sm:text-base">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        Cek keseuaian arsip
                    </a>
                </div>
            </div>

            @else
            <div class="max-w-3xl mx-auto">
                <div class="bg-white rounded-2xl shadow-xl p-6 sm:p-8 text-center border-t-4 border-red-500">
                    <div class="mb-4">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 bg-red-100 rounded-full flex items-center justify-center mx-auto">
                            <svg class="w-12 h-12 sm:w-14 sm:h-14 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-3">Arsip Tidak Valid!</h2>
                    <p class="text-gray-600 mb-6 text-sm sm:text-base leading-relaxed">
                        Arsip yang Anda cari tidak ditemukan dalam sistem.<br>
                        Dokumen ini <strong class="text-red-600">bukan merupakan arsip resmi</strong> Kesbangpol Buleleng
                    </p>

                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6 text-left">
                        <div class="flex items-start">
                            <div class="shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-800">
                                    <strong class="font-semibold">Perhatian!</strong> Jika Anda yakin dokumen ini seharusnya valid, silakan hubungi administrator sistem atau Kesbangpol Buleleng.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @endif
        </div>
    </main>

    <footer class="bg-gray-800 text-white py-6 sm:py-8 mt-12">
        <div class="container mx-auto px-4 sm:px-6 text-center">
            <p class="text-gray-400 text-xs sm:text-base">&copy; 2025 ARSIKA Buleleng. Prakom Kesbangpol</p>
        </div>
    </footer>
</body>

</html>