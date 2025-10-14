<x-legalizer.layout :active="$active" :link="$link">
    <x-legalizer.dashboard>
        <x-legalizer.card-jumlah-arsip :jumlahArsip="$jumlahArsip"></x-legalizer.card-jumlah-arsip>
        <x-card-jumlah-arsip-belum-legal :jumlahArsipBelumLegal="$jumlahArsipBelumLegal"></x-card-jumlah-arsip-belum-legal>
    </x-legalizer.dashboard>
</x-legalizer.layout>