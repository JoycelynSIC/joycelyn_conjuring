@extends('layouts.admin.app')

@section('content')
    <div class="py-4">

        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block mb-3">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item"><a href="{{ route('pelanggan.index') }}">Pelanggan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
            </ol>
        </nav>

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <div>
                <h1 class="h4 mb-1 text-dark">Edit Pelanggan</h1>
                <p class="text-muted mb-0">Form untuk memperbarui data pelanggan.</p>
            </div>
            <div>
                <a href="{{ route('pelanggan.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12 mb-4">
                <div class="card shadow-sm rounded-4 border-0">
                    <div class="card-body">
                        <form action="{{ route('pelanggan.update', $dataPelanggan->pelanggan_id)}}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row g-3">
                                {{-- Kolom Kiri --}}
                                <div class="col-lg-4 col-sm-6">
                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">First Name</label>
                                        <input type="text" name="first_name" value="{{ $dataPelanggan->first_name }}"
                                            id="first_name" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">Last Name</label>
                                        <input type="text" name="last_name" value="{{ $dataPelanggan->last_name }}"
                                            id="last_name" class="form-control" required>
                                    </div>
                                </div>

                                {{-- Kolom Tengah --}}
                                <div class="col-lg-4 col-sm-6">
                                    <div class="mb-3">
                                        <label for="birthday" class="form-label">Birthday</label>
                                        <input type="date" name="birthday" value="{{ $dataPelanggan->birthday }}"
                                            id="birthday" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select class="form-select" id="gender" name="gender">
                                            <option value="" disabled>-- Pilih Gender --</option>
                                            <option value="Female" {{ $dataPelanggan->gender == 'Female' ? 'selected' : '' }}>
                                                Female</option>
                                            <option value="Male" {{ $dataPelanggan->gender == 'Male' ? 'selected' : '' }}>Male
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Kolom Kanan --}}
                                <div class="col-lg-4 col-sm-12">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" value="{{ $dataPelanggan->email }}" id="email"
                                            class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" name="phone" value="{{ $dataPelanggan->phone }}" id="phone"
                                            class="form-control">
                                    </div>

                                    {{-- Multiple File Upload --}}
                                    <div class="mb-3">
                                        <label for="foto" class="form-label">Foto Pelanggan</label>
                                        <input type="file" name="foto[]" id="foto" class="form-control" multiple>
                                    </div>

                                    {{-- Thumbnail File & Floating Hapus --}}
                                    @if($dataPelanggan->fotos)
                                        <div class="mt-2 d-flex flex-wrap gap-2">
                                            @foreach($dataPelanggan->fotos as $index => $foto)
                                                <div class="position-relative" style="width:100px; height:100px;">
                                                    <img src="{{ asset('storage/' . $foto) }}"
                                                        class="img-thumbnail shadow-sm rounded-3"
                                                        style="width:100%; height:100%; object-fit:cover;">

                                                    {{-- Tombol Floating Hapus --}}
                                                        {{-- Tombol Floating Hapus --}}
                                                        <form
                                                            action="{{ route('pelanggan.file.destroy', [$dataPelanggan->pelanggan_id, $index]) }}"
                                                            method="POST" class="position-absolute top-0 end-0"
                                                            style="margin:4px; z-index:10;">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit"
                                                                class="btn btn-danger rounded-circle d-flex align-items-center justify-content-center"
                                                                style="width:26px; height:26px; padding:0; font-size:18px; line-height:1;"
                                                                onclick="return confirm('Hapus file ini?')">
                                                                &times;
                                                            </button>
                                                        </form>
                                                    </div>
                                            @endforeach
                                            </div>
                                    @endif


                                        {{-- Tombol Simpan & Batal --}}
                                        <div class="d-flex gap-2 mt-3">
                                            <button type="submit" class="btn btn-info flex-grow-1">Simpan Perubahan</button>
                                            <a href="{{ route('pelanggan.index') }}"
                                                class="btn btn-outline-secondary flex-grow-1">Batal</a>
                                        </div>

                                    </div>
                                </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection