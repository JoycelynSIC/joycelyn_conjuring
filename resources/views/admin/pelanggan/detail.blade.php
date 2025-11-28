@extends('layouts.admin.app')

@section('content')
<div class="py-4">
    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block mb-3">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item"><a href="{{ route('pelanggan.index') }}">Pelanggan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Pelanggan</li>
        </ol>
    </nav>

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <div>
            <h1 class="h4 mb-1 text-dark">Detail Pelanggan</h1>
            <p class="text-muted mb-0">Informasi lengkap pelanggan dan semua file/foto yang diupload.</p>
        </div>
        <div>
            <a href="{{ route('pelanggan.index') }}" class="btn btn-primary">Kembali</a>
        </div>
    </div>

    {{-- Card Detail --}}
    <div class="card shadow-sm rounded-4 border-0">
        <div class="card-body">
            <div class="row g-4">
                {{-- Kolom Data --}}
                <div class="col-lg-6 col-sm-12">
                    <ul class="list-group list-group-flush">
                        @foreach([
                            'First Name' => $dataPelanggan->first_name,
                            'Last Name' => $dataPelanggan->last_name,
                            'Birthday' => $dataPelanggan->birthday,
                            'Email' => $dataPelanggan->email,
                            'Phone' => $dataPelanggan->phone,
                        ] as $label => $value)
                            <li class="list-group-item py-2">
                                <strong>{{ $label }}:</strong> 
                                <span class="text-dark">{{ $value ?? '-' }}</span>
                            </li>
                        @endforeach
                        {{-- Gender --}}
                        <li class="list-group-item py-2">
                            <strong>Gender:</strong>
                            @if($dataPelanggan->gender == 'Male')
                                <span class="badge bg-primary">{{ $dataPelanggan->gender }}</span>
                            @elseif($dataPelanggan->gender == 'Female')
                                <span class="badge bg-pink text-dark">{{ $dataPelanggan->gender }}</span>
                            @else
                                <span class="badge bg-secondary">-</span>
                            @endif
                        </li>
                    </ul>
                </div>

                {{-- Kolom File/Foto --}}
                <div class="col-lg-6 col-sm-12">
                    <h5 class="mb-3">File / Foto Pelanggan</h5>
                    @if($dataPelanggan->fotos && count($dataPelanggan->fotos) > 0)
                        <div class="d-flex flex-wrap gap-3">
                            @foreach($dataPelanggan->fotos as $index => $foto)
                                @php
                                    $ext = strtolower(pathinfo($foto, PATHINFO_EXTENSION));
                                @endphp
                                <div class="position-relative text-center" style="width:120px;">
                                    {{-- Tombol Hapus File --}}
                                    <form action="{{ route('pelanggan.deleteFile', [$dataPelanggan->pelanggan_id, $index]) }}" 
                                          method="POST" class="position-absolute top-0 end-0" style="z-index:1;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                style="padding:2px 6px; font-size:12px;" 
                                                onclick="return confirm('Yakin ingin menghapus file ini?')">&times;</button>
                                    </form>

                                    @if(in_array($ext, ['jpg','jpeg','png','gif','webp']))
                                        <a href="{{ asset('storage/' . $foto) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $foto) }}" 
                                                class="img-thumbnail shadow-sm rounded-3" 
                                                style="width:120px; height:120px; object-fit:cover; transition: transform .2s;" 
                                                onmouseover="this.style.transform='scale(1.05)'" 
                                                onmouseout="this.style.transform='scale(1)'">
                                        </a>
                                    @else
                                        <a href="{{ asset('storage/' . $foto) }}" target="_blank" 
                                           class="d-block border rounded p-2 shadow-sm mb-1 text-center text-decoration-none text-dark" 
                                           style="height:120px; display:flex; align-items:center; justify-content:center; transition: background-color .2s;" 
                                           onmouseover="this.style.backgroundColor='#f1f1f1'" 
                                           onmouseout="this.style.backgroundColor='white'">
                                            <i class="bi bi-file-earmark-text" style="font-size:24px;"></i>
                                        </a>
                                    @endif
                                    <p class="small text-truncate mb-0" style="max-width:120px;">{{ basename($foto) }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">Belum ada file atau foto yang diupload.</p>
                    @endif
                </div>
            </div>

            {{-- Tombol Edit --}}
            <div class="mt-4 text-end">
                <a href="{{ route('pelanggan.edit', $dataPelanggan->pelanggan_id) }}" class="btn btn-info btn-lg">Edit Pelanggan</a>
            </div>
        </div>
    </div>
</div>
@endsection
