@extends('layouts.admin')
@section('title', 'Kelola User')
@section('header', 'Kelola User')

@section('content')
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="p-4 border-b flex flex-wrap gap-3 items-center justify-between">
        <form method="GET" class="flex gap-2">
            <select name="role" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-400">
                <option value="">Semua Role</option>
                @foreach(['admin','dokter','apoteker','pasien'] as $r)
                <option value="{{ $r }}" {{ request('role') === $r ? 'selected' : '' }}>{{ ucfirst($r) }}</option>
                @endforeach
            </select>
            <button class="bg-green-500 text-white px-4 py-2 rounded-lg text-sm">Filter</button>
        </form>
        <a href="{{ route('admin.users.create') }}" class="bg-green-500 text-white text-sm px-4 py-2 rounded-lg hover:bg-green-600">+ Tambah User</a>
    </div>
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="text-left px-4 py-3 text-gray-600">Nama</th>
                <th class="text-left px-4 py-3 text-gray-600">Email</th>
                <th class="text-center px-4 py-3 text-gray-600">Role</th>
                <th class="text-center px-4 py-3 text-gray-600">Status</th>
                <th class="text-center px-4 py-3 text-gray-600">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-4 py-3 font-medium">{{ $user->name }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $user->email }}</td>
                <td class="px-4 py-3 text-center">
                    @php $roleColors = ['admin'=>'red','dokter'=>'blue','apoteker'=>'purple','pasien'=>'green']; $rc = $roleColors[$user->role]??'gray'; @endphp
                    <span class="px-2 py-1 rounded-full text-xs bg-{{ $rc }}-100 text-{{ $rc }}-700">{{ ucfirst($user->role) }}</span>
                </td>
                <td class="px-4 py-3 text-center">
                    <span class="px-2 py-1 rounded-full text-xs {{ $user->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </td>
                <td class="px-4 py-3 text-center">
                    <div class="flex justify-center gap-2">
                        <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600 text-xs hover:underline">Edit</a>
                        <form method="POST" action="{{ route('admin.users.toggle', $user) }}">
                            @csrf @method('PATCH')
                            <button class="text-xs {{ $user->is_active ? 'text-orange-500' : 'text-green-600' }} hover:underline">
                                {{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                            </button>
                        </form>
                        @if($user->id !== auth()->id())
                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Hapus user?')">
                            @csrf @method('DELETE')
                            <button class="text-xs text-red-500 hover:underline">Hapus</button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-4 py-8 text-center text-gray-400">Tidak ada user.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4">{{ $users->withQueryString()->links() }}</div>
</div>
@endsection
