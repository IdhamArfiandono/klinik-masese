@extends('layouts.admin')
@section('title', 'Detail User')
@section('header', 'Detail User')

@section('content')
<div class="max-w-lg">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <dl class="space-y-2 text-sm">
            <div class="flex justify-between"><dt class="text-gray-500">Nama</dt><dd class="font-medium">{{ $user->name }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Email</dt><dd>{{ $user->email }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Role</dt><dd>{{ ucfirst($user->role) }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Telepon</dt><dd>{{ $user->phone ?? '-' }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Status</dt><dd>{{ $user->is_active ? 'Aktif' : 'Nonaktif' }}</dd></div>
        </dl>
        <div class="mt-4">
            <a href="{{ route('admin.users.edit', $user) }}" class="bg-green-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-600">Edit</a>
            <a href="{{ route('admin.users.index') }}" class="ml-2 text-gray-600 text-sm hover:underline">Kembali</a>
        </div>
    </div>
</div>
@endsection
