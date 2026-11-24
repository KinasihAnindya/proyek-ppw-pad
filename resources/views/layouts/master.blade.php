<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Berita & Isu')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('lightbox2/dist/css/lightbox.min.css') }}" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom mb-4 py-3">
        <div class="container">
            <a class="navbar-brand fw-bold text-dark fs-4 me-4" href="{{ url('/home') }}">
                Laravel
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-2">
                    <li class="nav-item">
                        <a class="nav-link text-secondary" href="{{ url('/home') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-secondary" href="{{ route('berita.index') }}">Data Berita</a>
                    </li>

                    @if(Auth::check() && Auth::user()->level == 'admin')
                        <li class="nav-item">
                            <a class="nav-link text-secondary" href="{{ route('jobs.index') }}">Lowongan Kerja</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-secondary" href="{{ route('users.index') }}">Manajemen Users</a>
                        </li>
                    @endif
                </ul>

                <ul class="navbar-nav ms-auto align-items-lg-center gap-2">
                    @auth
                        {{-- Dropdown Notifikasi Khusus Admin --}}
                        @if(Auth::user()->level == 'admin')
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-secondary position-relative" href="#" id="navbarNotifDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-bell"></i>
                                    @if(Auth::user()->unreadNotifications->count() > 0)
                                        <span class="badge rounded-pill bg-danger">
                                            {{ Auth::user()->unreadNotifications->count() }}
                                        </span>
                                    @endif
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm rounded-3 mt-2 p-2" aria-labelledby="navbarNotifDropdown" style="min-width: 310px;">
                                    <li class="dropdown-header fw-bold text-dark d-flex justify-content-between align-items-center">
                                        <span>Notifikasi Admin</span>
                                        <span class="badge bg-secondary">{{ Auth::user()->unreadNotifications->count() }} baru</span>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>

                                    @forelse(Auth::user()->notifications()->latest()->take(5)->get() as $notif)
                                        <li class="px-2 py-2 border-bottom small rounded {{ $notif->read_at ? 'text-muted' : 'fw-semibold text-dark bg-light' }}">
                                            <div>{{ $notif->data['pesan'] ?? 'Notifikasi baru' }}</div>
                                            <div class="text-muted mt-1" style="font-size: 11px;">
                                                {{ $notif->created_at->diffForHumans() }}
                                            </div>
                                        </li>
                                    @empty
                                        <li class="px-2 py-3 text-muted small text-center">
                                            Belum ada notifikasi.
                                        </li>
                                    @endforelse

                                    @if(Auth::user()->unreadNotifications->count() > 0)
                                        <li class="mt-2">
                                            <form action="{{ route('notifikasi.baca') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-primary w-100">
                                                    Tandai semua dibaca
                                                </button>
                                            </form>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif

                        {{-- Dropdown Profil & Logout --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-secondary fw-normal d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                @if(Auth::user()->avatar)
                                    <img src="{{ Auth::user()->avatar }}" alt="Avatar" class="rounded-circle me-2" width="26" height="26" referrerpolicy="no-referrer">
                                @else
                                    <i class="fa-solid fa-user-circle me-1"></i>
                                @endif
                                <span>{{ Auth::user()->name }} ({{ Auth::user()->level }})</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm rounded-3 mt-2" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item text-danger py-2" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="container pb-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-check me-1"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lightbox2/dist/js/lightbox-plus-jquery.min.js') }}"></script>
</body>
</html>