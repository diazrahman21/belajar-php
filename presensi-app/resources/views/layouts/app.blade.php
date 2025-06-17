<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Presensi')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .card {
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border: none;
            border-radius: 15px;
        }
        .navbar {
            backdrop-filter: blur(20px);
            background: rgba(255,255,255,0.95) !important;
        }
        .btn {
            border-radius: 10px;
        }
        .table {
            border-radius: 10px;
            overflow: hidden;
        }
        .table th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
        }
        .badge {
            font-size: 0.8em;
            padding: 0.5em 0.8em;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('presensi.index') }}">
                <i class="fas fa-clipboard-check me-2"></i>
                Sistem Presensi
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('presensi.index') }}">
                    <i class="fas fa-list me-1"></i>Daftar Presensi
                </a>
                <a class="nav-link" href="{{ route('presensi.create') }}">
                    <i class="fas fa-plus me-1"></i>Tambah Presensi
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
