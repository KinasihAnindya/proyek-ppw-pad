@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white font-weight-bold">
                    Dashboard Utama Admin
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h4>Selamat Datang, <strong>{{ Auth::user()->name }}</strong>!</h4>
                    <p class="text-muted">Anda telah berhasil login ke Sistem Pengelolaan Berita & Isu.</p>
                    
                    <hr>

                    <div class="mt-3">
                        <a href="{{ route('berita.index') }}" class="btn btn-primary btn-lg">
                            Kelola Data Berita & Isu &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection