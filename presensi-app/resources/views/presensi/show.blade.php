@extends('layouts.app')

@section('title', 'Detail Presensi')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-eye me-2"></i>
                    Detail Data Presensi
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-user me-1"></i>Nama Lengkap
                            </label>
                            <p class="form-control-plaintext">{{ $presensi->nama }}</p>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-id-card me-1"></i>NIM
                            </label>
                            <p class="form-control-plaintext">{{ $presensi->nim ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-calendar me-1"></i>Tanggal
                            </label>
                            <p class="form-control-plaintext">{{ $presensi->tanggal->format('d F Y') }}</p>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-clock me-1"></i>Waktu
                            </label>
                            <p class="form-control-plaintext">{{ \Carbon\Carbon::parse($presensi->waktu)->format('H:i') }} WIB</p>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">
                        <i class="fas fa-check-circle me-1"></i>Status Kehadiran
                    </label>
                    <div class="mt-2">
                        @if($presensi->status == 'Hadir')
                            <span class="badge bg-success fs-6 px-3 py-2">
                                <i class="fas fa-check me-1"></i>{{ $presensi->status }}
                            </span>
                        @elseif($presensi->status == 'Izin')
                            <span class="badge bg-warning fs-6 px-3 py-2">
                                <i class="fas fa-clock me-1"></i>{{ $presensi->status }}
                            </span>
                        @elseif($presensi->status == 'Sakit')
                            <span class="badge bg-info fs-6 px-3 py-2">
                                <i class="fas fa-thermometer me-1"></i>{{ $presensi->status }}
                            </span>
                        @else
                            <span class="badge bg-danger fs-6 px-3 py-2">
                                <i class="fas fa-times me-1"></i>{{ $presensi->status }}
                            </span>
                        @endif
                    </div>
                </div>

                @if($presensi->keterangan)
                <div class="mb-4">
                    <label class="form-label fw-bold">
                        <i class="fas fa-comment me-1"></i>Keterangan
                    </label>
                    <div class="alert alert-light border">
                        {{ $presensi->keterangan }}
                    </div>
                </div>
                @endif

                <div class="mb-3">
                    <label class="form-label fw-bold">
                        <i class="fas fa-info-circle me-1"></i>Informasi Tambahan
                    </label>
                    <div class="row">
                        <div class="col-md-6">
                            <small class="text-muted">
                                <i class="fas fa-plus me-1"></i>Dibuat: {{ $presensi->created_at->format('d/m/Y H:i') }}
                            </small>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted">
                                <i class="fas fa-edit me-1"></i>Diperbarui: {{ $presensi->updated_at->format('d/m/Y H:i') }}
                            </small>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('presensi.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                    <div>
                        <a href="{{ route('presensi.edit', $presensi) }}" class="btn btn-warning me-2">
                            <i class="fas fa-edit me-2"></i>Edit
                        </a>
                        <form action="{{ route('presensi.destroy', $presensi) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                <i class="fas fa-trash me-2"></i>Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
