@extends('layouts.app')

@section('title', 'Edit Presensi')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-edit me-2"></i>
                    Edit Data Presensi
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('presensi.update', $presensi) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama" class="form-label">
                                    <i class="fas fa-user me-1"></i>Nama Lengkap
                                </label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                       id="nama" name="nama" value="{{ old('nama', $presensi->nama) }}" required>
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
                                       id="nim" name="nim" value="{{ old('nim', $presensi->nim) }}">
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
                                       id="tanggal" name="tanggal" value="{{ old('tanggal', $presensi->tanggal->format('Y-m-d')) }}" required>
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
                                       id="waktu" name="waktu" value="{{ old('waktu', \Carbon\Carbon::parse($presensi->waktu)->format('H:i')) }}" required>
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
                            <option value="Hadir" {{ old('status', $presensi->status) == 'Hadir' ? 'selected' : '' }}>
                                Hadir
                            </option>
                            <option value="Izin" {{ old('status', $presensi->status) == 'Izin' ? 'selected' : '' }}>
                                Izin
                            </option>
                            <option value="Sakit" {{ old('status', $presensi->status) == 'Sakit' ? 'selected' : '' }}>
                                Sakit
                            </option>
                            <option value="Alpha" {{ old('status', $presensi->status) == 'Alpha' ? 'selected' : '' }}>
                                Alpha
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
                                  placeholder="Masukkan keterangan tambahan jika diperlukan">{{ old('keterangan', $presensi->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('presensi.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Data
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

    // Trigger change event on page load to set initial state
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('status').dispatchEvent(new Event('change'));
    });
</script>
@endsection
