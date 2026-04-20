@extends('layouts.admin')
@section('title', 'Edit User')
@section('header', 'Edit User')

@section('content')
<div class="max-w-lg">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf @method('PUT')
            <div class="space-y-4 mb-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru (kosongkan jika tidak diubah)</label>
                    <input type="password" name="password" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                    <select name="role" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400">
                        @foreach(['apoteker','pasien','admin','dokter'] as $r)
                        <option value="{{ $r }}" {{ old('role', $user->role) === $r ? 'selected' : '' }}>{{ ucfirst($r) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400">
                </div>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 font-medium">Simpan</button>
                <a href="{{ route('admin.users.index') }}" class="border border-gray-300 text-gray-600 px-6 py-2 rounded-lg hover:bg-gray-50">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
