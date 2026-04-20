@extends('layouts.admin')
@section('title', 'Laporan')
@section('header', 'Laporan')

@section('content')
<div class="space-y-6">

    {{-- Filter Tahun --}}
    <form method="GET" class="flex gap-3 items-center">
        <select name="year" class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
            @for($y = now()->year; $y >= now()->year - 3; $y--)
            <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
            @endfor
        </select>
        <button class="bg-green-500 text-white px-4 py-2 rounded-lg text-sm">Tampilkan</button>
    </form>

    {{-- Pendapatan Bulanan --}}
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="font-semibold text-gray-700 mb-4">Pendapatan Apotek {{ $year }}</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
            @php $bulan = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des']; @endphp
            @foreach($pendapatanBulanan as $m => $total)
            <div class="bg-green-50 rounded-lg p-3 text-center">
                <p class="text-xs text-gray-500 mb-1">{{ $bulan[$m-1] }}</p>
                <p class="font-bold text-green-700 text-sm">Rp {{ number_format($total/1000, 0, ',', '.') }}K</p>
            </div>
            @endforeach
        </div>
        <div class="mt-4 pt-4 border-t flex justify-between">
            <span class="font-semibold text-gray-700">Total Tahun {{ $year }}</span>
            <span class="font-bold text-green-700">Rp {{ number_format(array_sum($pendapatanBulanan), 0, ',', '.') }}</span>
        </div>
    </div>

    {{-- Appointment per Dokter --}}
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="font-semibold text-gray-700 mb-4">Total Appointment per Dokter</h2>
        <table class="w-full text-sm">
            <thead class="border-b">
                <tr>
                    <th class="text-left pb-2 text-gray-600">Dokter</th>
                    <th class="text-left pb-2 text-gray-600">Spesialisasi</th>
                    <th class="text-center pb-2 text-gray-600">Total Appointment</th>
                    <th class="text-center pb-2 text-gray-600">Selesai</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointmentPerDokter as $d)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-2 font-medium">{{ $d->user->name }}</td>
                    <td class="py-2 text-gray-600">{{ $d->specialization }}</td>
                    <td class="py-2 text-center">{{ $d->total_appointments }}</td>
                    <td class="py-2 text-center text-green-700 font-medium">{{ $d->completed_appointments }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Obat Terlaris --}}
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="font-semibold text-gray-700 mb-4">Obat Terlaris</h2>
        <table class="w-full text-sm">
            <thead class="border-b">
                <tr>
                    <th class="text-left pb-2 text-gray-600">Nama Obat</th>
                    <th class="text-center pb-2 text-gray-600">Total Terjual</th>
                    <th class="text-right pb-2 text-gray-600">Total Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($obatTerlaris as $item)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-2 font-medium">{{ $item->medicine->name }}</td>
                    <td class="py-2 text-center">{{ $item->total_quantity }} {{ $item->medicine->unit }}</td>
                    <td class="py-2 text-right text-purple-700 font-medium">Rp {{ number_format($item->total_revenue, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
