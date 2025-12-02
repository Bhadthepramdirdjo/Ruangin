@extends('layouts.app')

@section('title', 'Riwayat Booking')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-3xl font-bold mb-6">Riwayat Booking</h1>

    @if ($bookings->count() > 0)
        <div class="grid grid-cols-1 gap-4">
            @foreach ($bookings as $booking)
                <div class="bg-white rounded-lg shadow p-4 border-l-4 
                    @if ($booking->status === 'pending')
                        border-yellow-500
                    @elseif ($booking->status === 'disetujui')
                        border-green-500
                    @else
                        border-red-500
                    @endif">
                    
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-xl font-bold">{{ $booking->ruangan->nama_ruang ?? 'Ruangan Tidak Ditemukan' }}</h2>
                            <p class="text-gray-600"><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($booking->tanggal)->format('d-m-Y') }}</p>
                            <p class="text-gray-600"><strong>Jam:</strong> {{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</p>
                            <p class="text-gray-600"><strong>Keperluan:</strong> {{ $booking->keperluan }}</p>
                            <p class="text-gray-600"><strong>Dibuat:</strong> {{ \Carbon\Carbon::parse($booking->dibuat)->format('d-m-Y H:i') }}</p>
                        </div>
                        <div class="text-right">
                            <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                                @if ($booking->status === 'pending')
                                    bg-yellow-100 text-yellow-800
                                @elseif ($booking->status === 'disetujui')
                                    bg-green-100 text-green-800
                                @else
                                    bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-gray-100 rounded-lg p-6 text-center">
            <p class="text-gray-600">Tidak ada riwayat booking</p>
        </div>
    @endif
</div>
@endsection
