@extends('layouts.app')

@section('title', 'Edit Ruangan')

@section('content')
<div class="container mx-auto py-6">
    <div class="max-w-md mx-auto bg-white rounded-lg shadow p-6">
        <h1 class="text-2xl font-bold mb-6">Edit Ruangan</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('ruangan.update', $ruangan->id_ruangan) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nama_ruang" class="block text-sm font-semibold text-gray-700 mb-2">Nama Ruang</label>
                <input type="text" id="nama_ruang" name="nama_ruang" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" value="{{ $ruangan->nama_ruang }}" required>
            </div>

            <div class="mb-4">
                <label for="kapasitas" class="block text-sm font-semibold text-gray-700 mb-2">Kapasitas</label>
                <input type="number" id="kapasitas" name="kapasitas" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" value="{{ $ruangan->kapasitas }}" required>
            </div>

            <div class="mb-4">
                <label for="lokasi" class="block text-sm font-semibold text-gray-700 mb-2">Lokasi</label>
                <input type="text" id="lokasi" name="lokasi" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" value="{{ $ruangan->lokasi }}" required>
            </div>

            <div class="mb-4">
                <label for="tipe" class="block text-sm font-semibold text-gray-700 mb-2">Tipe</label>
                <input type="text" id="tipe" name="tipe" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" value="{{ $ruangan->tipe }}">
            </div>

            <div class="mb-6">
                <label for="keterangan" class="block text-sm font-semibold text-gray-700 mb-2">Keterangan</label>
                <textarea id="keterangan" name="keterangan" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" rows="4">{{ $ruangan->keterangan }}</textarea>
            </div>

            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Update Ruangan
            </button>
        </form>
    </div>
</div>
@endsection
