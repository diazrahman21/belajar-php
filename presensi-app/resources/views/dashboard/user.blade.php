@extends('layouts.app')

@section('title', 'User Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="fas fa-user me-2"></i>
                    Dashboard User
                </h4>
                <p class="text-muted">Selamat datang, {{ auth()->user()->name }}!</p>
            </div>
        </div>
    </div>
</div>

<!-- My Statistics -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                <h4 class="text-success">{{ $myStats['hadir'] }}</h4>
                <small class="text-muted">Hadir</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-clock fa-2x text-warning mb-2"></i>
                <h4 class="text-warning">{{ $myStats['izin'] }}</h4>
                <small class="text-muted">Izin</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-thermometer fa-2x text-info mb-2"></i>
                <h4 class="text-info">{{ $myStats['sakit'] }}</h4>
                <small class="text-muted">Sakit</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-times-circle fa-2x text-danger mb-2"></i>
                <h4 class="text-danger">{{ $myStats['alpha'] }}</h4>
                <small class="text-muted">Alpha</small>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-history me-2"></i>
                    Riwayat Presensi Saya
                </h5>
            </div>
            <div class="card-body">
                @if($myPresensis->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($myPresensis as $presensi)
                                <tr>
                                    <td>{{ $presensi->tanggal->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($presensi->waktu)->format('H:i') }}</td>
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
                                    <td>{{ Str::limit($presensi->keterangan, 30) ?? '-' }}</td>
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
                        <p class="text-muted">Belum ada riwayat presensi</p>
                        <a href="{{ route('presensi.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>
                            Buat Presensi Pertama
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-plus-circle me-2"></i>
                    Presensi Hari Ini
                </h5>
            </div>
            <div class="card-body text-center">
                <div class="mb-3">
                    <i class="fas fa-calendar-check fa-3x text-primary mb-3"></i>
                    <h5>{{ \Carbon\Carbon::now()->format('d F Y') }}</h5>
                    <p class="text-muted">{{ \Carbon\Carbon::now()->format('l') }}</p>
                </div>
                
                @php
                    $todayPresensi = $myPresensis->where('tanggal', \Carbon\Carbon::today()->format('Y-m-d'))->first();
                @endphp
                
                @if($todayPresensi)
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle me-2"></i>
                        <strong>Sudah Presensi!</strong><br>
                        Status: {{ $todayPresensi->status }}<br>
                        Waktu: {{ \Carbon\Carbon::parse($todayPresensi->waktu)->format('H:i') }}
                    </div>
                @else
                    <a href="{{ route('presensi.create') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus me-2"></i>
                        Presensi Sekarang
                    </a>
                @endif
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-tools me-2"></i>
                    Menu Cepat
                </h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('presensi.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>
                        Buat Presensi
                    </a>
                    <a href="{{ route('presensi.index') }}" class="btn btn-info">
                        <i class="fas fa-list me-2"></i>
                        Lihat Riwayat
                    </a>
                    <a href="{{ route('profile.edit') }}" class="btn btn-secondary">
                        <i class="fas fa-user-edit me-2"></i>
                        Edit Profile
                    </a>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-info-circle me-2"></i>
                    Informasi Akun
                </h5>
            </div>
            <div class="card-body">
                <small class="text-muted">
                    <div class="mb-2">
                        <i class="fas fa-user me-1"></i>
                        Nama: <strong>{{ auth()->user()->name }}</strong>
                    </div>
                    <div class="mb-2">
                        <i class="fas fa-envelope me-1"></i>
                        Email: <strong>{{ auth()->user()->email }}</strong>
                    </div>
                    <div class="mb-2">
                        <i class="fas fa-shield-alt me-1"></i>
                        Role: <span class="badge bg-success">User</span>
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
