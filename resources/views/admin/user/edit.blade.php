@extends('layouts.admin.app')

@section('content')
    <div class="py-5">
        <div class="container">
            {{-- Judul --}}
            <div class="text-center mb-4">
                <h1 class="h3 fw-bold">Profil</h1>
                <p class="text-muted mb-0">Perbarui data profil Anda di sini.</p>
            </div>

            {{-- Card Form --}}
            <div class="card shadow-sm mx-auto" style="max-width: 800px;">
                <div class="card-body">

                    <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Foto Profil --}}
                        <div class="text-center mb-4">
                            @if ($user->profile_picture)
                                <img src="{{ asset('storage/' . $user->profile_picture) }}" class="rounded-circle mb-2"
                                    style="width: 120px; height: 120px; object-fit: cover;">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random"
                                    class="rounded-circle mb-2" style="width: 120px; height: 120px; object-fit: cover;">
                            @endif

                            {{-- Upload Foto Baru --}}
                            <div class="text-center mb-3">
                                <input type="file" name="profile_picture" class="form-control mx-auto"
                                    style="max-width: 250px;">
                            </div>

                            {{-- Tombol Hapus Foto --}}
                            @if ($user->profile_picture)
                                <div class="text-center mt-2">
                                    <form action="{{ route('user.destroyProfilePicture', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus Foto</button>
                                    </form>
                                </div>
                            @endif


                            {{-- Row Input --}}
                            <div class="row mt-4">
                                {{-- Kolom Kiri: Nama, Email, Role --}}
                                <div class="col-md-6 mb-3">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Lengkap</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name', $user->name) }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email', $user->email) }}" required>
                                    </div>

                                    {{-- Tambahan Input Role --}}
                                    <div class="mb-3">
                                        <label for="role" class="form-label">Role</label>
                                        <select name="role" class="form-control">
                                            <option value="super admin" {{ $user->role == 'super admin' ? 'selected' : '' }}>
                                                Super Admin</option>
                                            <option value="pelanggan" {{ $user->role == 'pelanggan' ? 'selected' : '' }}>
                                                Pelanggan</option>
                                            <option value="mitra" {{ $user->role == 'mitra' ? 'selected' : '' }}>Mitra
                                            </option>
                                        </select>
                                    </div>

                                </div>

                                {{-- Kolom Kanan: Password --}}
                                <div class="col-md-6 mb-3">
                                    <div class="mb-3">
                                        <label class="form-label">Password Baru (opsional)</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Konfirmasi Password</label>
                                        <input type="password" name="password_confirmation" class="form-control">
                                    </div>
                                </div>
                            </div>

                            {{-- Tombol Update/Batal --}}
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary me-2">Update</button>
                                <a href="{{ route('user.index') }}" class="btn btn-outline-secondary">Batal</a>
                            </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection