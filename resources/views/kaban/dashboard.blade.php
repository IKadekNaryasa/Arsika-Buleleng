<x-kaban.layout :active="$active" :link="$link">
    <x-kaban.dashboard>
        <x-kaban.card-jumlah-arsip :jumlahArsip="$jumlahArsip"></x-kaban.card-jumlah-arsip>
        <x-card-jumlah-arsip-belum-legal :jumlahArsipBelumLegal="$jumlahArsipBelumLegal"></x-card-jumlah-arsip-belum-legal>
    </x-kaban.dashboard>
</x-kaban.layout>