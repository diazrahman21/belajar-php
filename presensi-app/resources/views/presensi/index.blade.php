@extends('layouts.app')

@section('title', 'Daftar Presensi')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-list me-2"></i>
                        Daftar Presensi
                    </h5>
                    <a href="{{ route('presensi.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>
                        Tambah Presensi
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if($presensis->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NIM</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($presensis as $key => $presensi)
                                <tr>
                                    <td>{{ $presensis->firstItem() + $key }}</td>
                                    <td>
                                        <div class="fw-bold">{{ $presensi->nama }}</div>
                                    </td>
                                    <td>{{ $presensi->nim ?? '-' }}</td>
                                    <td>
                                        @if($presensi->status == 'Hadir')
                                            <span class="badge bg-success">
                                                <i class="fas fa-check me-1"></i>{{ $presensi->status }}
                                            </span>
                                        @elseif($presensi->status == 'Izin')
                                            <span class="badge bg-warning">
                                                <i class="fas fa-clock me-1"></i>{{ $presensi->status }}
                                            </span>
                                        @elseif($presensi->status == 'Sakit')
                                            <span class="badge bg-info">
                                                <i class="fas fa-thermometer me-1"></i>{{ $presensi->status }}
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                <i class="fas fa-times me-1"></i>{{ $presensi->status }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ $presensi->tanggal->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($presensi->waktu)->format('H:i') }}</td>
                                    <td>{{ Str::limit($presensi->keterangan, 30) ?? '-' }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('presensi.show', $presensi) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('presensi.edit', $presensi) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('presensi.destroy', $presensi) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="d-flex justify-content-center mt-3">
                        {{ $presensis->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Belum ada data presensi</h5>
                        <p class="text-muted">Klik tombol "Tambah Presensi" untuk menambahkan data</p>
                        <a href="{{ route('presensi.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>
                            Tambah Presensi
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Summary Statistics -->
<div class="row mt-4">
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                <h4 class="text-success">{{ $presensis->where('status', 'Hadir')->count() }}</h4>
                <small class="text-muted">Hadir</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-clock fa-2x text-warning mb-2"></i>
                <h4 class="text-warning">{{ $presensis->where('status', 'Izin')->count() }}</h4>
                <small class="text-muted">Izin</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-thermometer fa-2x text-info mb-2"></i>
                <h4 class="text-info">{{ $presensis->where('status', 'Sakit')->count() }}</h4>
                <small class="text-muted">Sakit</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-times-circle fa-2x text-danger mb-2"></i>
                <h4 class="text-danger">{{ $presensis->where('status', 'Alpha')->count() }}</h4>
                <small class="text-muted">Alpha</small>
            </div>
        </div>
    </div>
</div>
@endsection
