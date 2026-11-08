@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    body {
        background-color: #f8f9fa;
    }
    .card {
        border-radius: 12px;
    }
    .table thead th {
        font-weight: 600;
        color: #495057;
    }
</style>

<div class="container my-4">
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <div class="d-flex align-items-center mb-2">
                <h3 class="fw-bold text-primary mb-0">
                    <i class="bi bi-people-fill me-2"></i>Daftar Users & Hak Akses
                </h3>
            </div>

            <p class="text-muted">Menampilkan daftar seluruh pengguna beserta level otorisasi sistem.</p>

            <div class="table-responsive mt-4">
                <table class="table table-hover align-middle border-top">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" style="width: 70px;">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col" style="width: 160px;">Level Akses</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $key => $user)
                        <tr>
                            <td class="fw-bold">{{ $key + 1 }}</td>
                            <td class="fw-bold text-primary">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if(strtolower($user->level) == 'admin')
                                    <span class="badge bg-danger rounded-pill px-3 py-2">
                                        <i class="bi bi-shield-lock-fill me-1"></i> ADMIN
                                    </span>
                                @else
                                    <span class="badge bg-secondary rounded-pill px-3 py-2">
                                        <i class="bi bi-person-fill me-1"></i> USER
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection