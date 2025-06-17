@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="fas fa-user-shield me-2"></i>
                    Dashboard Admin
                </h4>
                <p class="text-muted">Selamat datang, {{ auth()->user()->name }}!</p>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-users fa-3x text-primary mb-3"></i>
                <h3 class="text-primary">{{ $totalUsers }}</h3>
                <p class="text-muted">Total Users</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-clipboard-list fa-3x text-info mb-3"></i>
                <h3 class="text-info">{{ $totalPresensis }}</h3>
                <p class="text-muted">Total Presensi</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-calendar-day fa-3x text-warning mb-3"></i>
                <h3 class="text-warning">{{ $todayPresensis }}</h3>
                <p class="text-muted">Presensi Hari Ini</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                <h3 class="text-success">{{ $todayHadir }}</h3>
                <p class="text-muted">Hadir Hari Ini</p>
            </div>
        </div>
    </div>
</div>

<!-- Status Statistics -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                <h4 class="text-success">{{ $statusStats['hadir'] }}</h4>
                <small class="text-muted">Total Hadir</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-clock fa-2x text-warning mb-2"></i>
                <h4 class="text-warning">{{ $statusStats['izin'] }}</h4>
                <small class="text-muted">Total Izin</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-thermometer fa-2x text-info mb-2"></i>
                <h4 class="text-info">{{ $statusStats['sakit'] }}</h4>
                <small class="text-muted">Total Sakit</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-times-circle fa-2x text-danger mb-2"></i>
                <h4 class="text-danger">{{ $statusStats['alpha'] }}</h4>
                <small class="text-muted">Total Alpha</small>
            </div>
        </div>
    </div>
</div>

<!-- Recent Presensi -->
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-clock me-2"></i>
                    Presensi Terbaru
                </h5>
            </div>
            <div class="card-body">
                @if($recentPresensis->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentPresensis as $presensi)
                                <tr>
                                    <td>{{ $presensi->nama }}</td>
                                    <td>
                                        @if($presensi->status == 'Hadir')
                                            <span class="badge bg-success">{{ $presensi->status }}</span>
                                        @elseif($presensi->status == 'Izin')
                                            <span class="badge bg-warning">{{ $presensi->status }}</span>
                                        @elseif($presensi->status == 'Sakit')
                                            <span class="badge bg-info">{{ $presensi->status }}</span>
                                        @else
                                            <span class="badge bg-danger">{{ $presensi->status }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $presensi->tanggal->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($presensi->waktu)->format('H:i') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{ route('presensi.index') }}" class="btn btn-primary">
                            <i class="fas fa-list me-2"></i>
                            Lihat Semua Presensi
                        </a>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Belum ada data presensi</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-tools me-2"></i>
                    Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('presensi.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>
                        Tambah Presensi
                    </a>
                    <a href="{{ route('presensi.index') }}" class="btn btn-info">
                        <i class="fas fa-list me-2"></i>
                        Kelola Presensi
                    </a>
                    <a href="#" class="btn btn-success">
                        <i class="fas fa-download me-2"></i>
                        Export Data
                    </a>
                    <a href="#" class="btn btn-warning">
                        <i class="fas fa-chart-bar me-2"></i>
                        Laporan
                    </a>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-info-circle me-2"></i>
                    Informasi Sistem
                </h5>
            </div>
            <div class="card-body">
                <small class="text-muted">
                    <div class="mb-2">
                        <i class="fas fa-user me-1"></i>
                        Login sebagai: <strong>{{ auth()->user()->name }}</strong>
                    </div>
                    <div class="mb-2">
                        <i class="fas fa-shield-alt me-1"></i>
                        Role: <span class="badge bg-primary">Admin</span>
                    </div>
                    <div>
                        <i class="fas fa-clock me-1"></i>
                        {{ \Carbon\Carbon::now()->format('d F Y, H:i') }}
                    </div>
                </small>
            </div>
        </div>
    </div>
</div>
@endsection
