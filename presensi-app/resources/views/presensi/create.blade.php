@extends('layouts.app')

@section('title', 'Tambah Presensi')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-plus me-2"></i>
                    Tambah Data Presensi
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('presensi.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama" class="form-label">
                                    <i class="fas fa-user me-1"></i>Nama Lengkap
                                </label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                       id="nama" name="nama" value="{{ old('nama') }}" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nim" class="form-label">
                                    <i class="fas fa-id-card me-1"></i>NIM (Opsional)
                                </label>
                                <input type="text" class="form-control @error('nim') is-invalid @enderror" 
                                       id="nim" name="nim" value="{{ old('nim') }}">
                                @error('nim')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">
                                    <i class="fas fa-calendar me-1"></i>Tanggal
                                </label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" 
                                       id="tanggal" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="waktu" class="form-label">
                                    <i class="fas fa-clock me-1"></i>Waktu
                                </label>
                                <input type="time" class="form-control @error('waktu') is-invalid @enderror" 
                                       id="waktu" name="waktu" value="{{ old('waktu', date('H:i')) }}" required>
                                @error('waktu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">
                            <i class="fas fa-check-circle me-1"></i>Status Kehadiran
                        </label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="">Pilih Status</option>
                            <option value="Hadir" {{ old('status') == 'Hadir' ? 'selected' : '' }}>
                                <i class="fas fa-check"></i> Hadir
                            </option>
                            <option value="Izin" {{ old('status') == 'Izin' ? 'selected' : '' }}>
                                <i class="fas fa-clock"></i> Izin
                            </option>
                            <option value="Sakit" {{ old('status') == 'Sakit' ? 'selected' : '' }}>
                                <i class="fas fa-thermometer"></i> Sakit
                            </option>
                            <option value="Alpha" {{ old('status') == 'Alpha' ? 'selected' : '' }}>
                                <i class="fas fa-times"></i> Alpha
                            </option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="keterangan" class="form-label">
                            <i class="fas fa-comment me-1"></i>Keterangan (Opsional)
                        </label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                                  id="keterangan" name="keterangan" rows="3" 
                                  placeholder="Masukkan keterangan tambahan jika diperlukan">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('presensi.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Auto fill current time when page loads
    document.addEventListener('DOMContentLoaded', function() {
        const waktuInput = document.getElementById('waktu');
        if (!waktuInput.value) {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            waktuInput.value = `${hours}:${minutes}`;
        }
    });

    // Show/hide keterangan based on status
    document.getElementById('status').addEventListener('change', function() {
        const keteranganDiv = document.getElementById('keterangan').parentElement;
        const keteranganLabel = keteranganDiv.querySelector('label');
        
        if (this.value === 'Izin' || this.value === 'Sakit') {
            keteranganLabel.innerHTML = '<i class="fas fa-comment me-1"></i>Keterangan';
            document.getElementById('keterangan').setAttribute('placeholder', 'Masukkan alasan ' + this.value.toLowerCase());
        } else {
            keteranganLabel.innerHTML = '<i class="fas fa-comment me-1"></i>Keterangan (Opsional)';
            document.getElementById('keterangan').setAttribute('placeholder', 'Masukkan keterangan tambahan jika diperlukan');
        }
    });
</script>
@endsection
