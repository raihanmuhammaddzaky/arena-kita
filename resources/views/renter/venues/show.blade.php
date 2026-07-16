@extends('layouts.app')

@section('content')

<!-- Custom Alert Banner (Hidden by default) -->
<div id="custom-alert" class="fixed top-24 left-1/2 -translate-x-1/2 z-[100] hidden bg-[#ef4444] text-white font-body-md px-6 py-4 rounded-xl shadow-lg flex items-center gap-3 transition-opacity duration-300 w-11/12 max-w-md">
    <x-ui.icon name="error" />
    <span id="custom-alert-message">Peringatan: Anda belum memilih waktu bermain.</span>
</div>

<div class="flex-grow w-full max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-stack-md relative z-10">
    
    <!-- Breadcrumb Navigation -->
    <x-ui.breadcrumb :links="[
        ['label' => 'Beranda', 'url' => route('renter.dashboard')],
        ['label' => 'Katalog Lapangan', 'url' => route('renter.venues.index')],
        ['label' => $venue->name, 'url' => '']
    ]" />

    <!-- Gallery Slider -->
    <x-venues.detail-header :venue="$venue" />

    <!-- Content Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-gutter items-start">
        
        <!-- Main Info -->
        <x-venues.detail-info :venue="$venue" />

        <!-- Sticky Booking Card & Form -->
        <x-venues.booking-form :venue="$venue" />

    </div>
</div>
@endsection
