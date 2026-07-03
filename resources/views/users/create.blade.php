@extends('layouts.app')

@section('title', 'Tambah Pengguna')
@section('page-title', 'Tambah Pengguna')

@section('content')
<div class="max-w-lg">
    <div class="mb-6">
        <a href="{{ route('users.index') }}" class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-indigo-600 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-8">
        <div class="mb-6">
            <h2 class="text-xl font-bold text-slate-900">Tambah Pengguna Baru</h2>
            <p class="text-sm text-slate-500 mt-1">Masukkan informasi pengguna</p>
        </div>

        <form method="POST" action="{{ route('users.store') }}" class="space-y-5">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">Nama Pengguna</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="Contoh : Budi"
                    class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-400 transition-all">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required placeholder="example@gmail.com"
                    class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-400 transition-all">
            </div>

            <div>
                <label for="role" class="block text-sm font-medium text-slate-700 mb-1.5">Role</label>
                <select name="role" id="role" onchange="roleChange()" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-400 transition-all">
                    <option value="">Pilih Role</option>
                    <option value="Staff IT">Staff IT</option>
                    <option value="Kepala UPT Lab">Kepala UPT Lab</option>
                </select>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Password</label>
                <input type="password" name="password" id="password" placeholder="Password"
                    class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-400 transition-all">
            </div>

            <div id="wrapper-nidn" class="hidden">
                <label for="nidn" class="block text-sm font-medium text-slate-700 mb-1.5">Nomor Induk Dosen Nasional</label>
                <input type="text" name="nidn" id="nidn" value="{{ old('nidn') }}" placeholder="NIDN"
                    class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-400 transition-all">
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                <button type="submit"
                    class="px-6 py-2.5 bg-indigo-600 text-white text-sm font-semibold rounded-xl hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition-all duration-200">
                    Simpan Pengguna
                </button>
                <a href="{{ route('users.index') }}"
                    class="px-6 py-2.5 bg-slate-100 text-slate-600 text-sm font-medium rounded-xl hover:bg-slate-200 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    function roleChange() {
        const role = document.getElementById('role').value;
        const wrapperNidn = document.getElementById('wrapper-nidn');
        const inputNidn = document.getElementById('nidn');

        if (role === 'Staff IT') {
            wrapperNidn.classList.add('hidden');
            inputNidn.removeAttribute('required');
        } else if (role === 'Kepala UPT Lab') {
            wrapperNidn.classList.remove('hidden');
            inputNidn.setAttribute('required', 'required');
        } else {
            wrapperNidn.classList.add('hidden');
            inputNidn.removeAttribute('required');
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        roleChange();
    });
</script>
@endsection