@extends('layouts.app')

@section('title', 'Dashboard Organization')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-gray-800 mb-0">Selamat Datang, {{ Auth::user()->name }}! 👋</h4>
            <p class="text-muted small">Kelola dan pantau semua acara {{ Auth::user()->organization }} di sini.</p>
        </div>
    </div>

    @if($rejectedEvents->count() > 0)
        @foreach($rejectedEvents as $reject)
        <div class="alert alert-danger border-0 shadow-sm d-flex align-items-start mb-4" role="alert">
            <i class="fas fa-exclamation-circle fa-2x me-3 mt-1"></i>
            <div>
                <h6 class="fw-bold mb-1">Acara "{{ $reject->title }}" Ditolak Kampus!</h6>
                <p class="mb-0 small"><strong>Catatan Superadmin:</strong> {{ $reject->reject_reason }}</p>
                <a href="{{ route('events.index') }}" class="btn btn-sm btn-outline-danger mt-2 fw-bold">Revisi Sekarang</a>
            </div>
        </div>
        @endforeach
    @endif

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100" style="border-left: 5px solid var(--primary-color) !important;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted text-uppercase fw-bold mb-1" style="font-size: 0.8rem;">Total Acara Dibuat</p>
                            <h2 class="fw-bold mb-0 text-dark">1 <span class="fs-6 text-muted fw-normal">Acara</span></h2>
                        </div>
                        <div class="bg-light p-3 rounded-circle text-primary">
                            <i class="fas fa-calendar-alt fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100" style="border-left: 5px solid #28a745 !important;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted text-uppercase fw-bold mb-1" style="font-size: 0.8rem;">Total Pendaftar</p>
                            <h2 class="fw-bold mb-0 text-dark">0 <span class="fs-6 text-muted fw-normal">Mahasiswa</span></h2>
                        </div>
                        <div style="background-color: #e6f4ea;" class="p-3 rounded-circle text-success">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100" style="border-left: 5px solid #ffc107 !important;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted text-uppercase fw-bold mb-1" style="font-size: 0.8rem;">Aktivitas Terakhir</p>
                            <h2 class="fw-bold mb-0 fs-5 mt-2 text-warning">Ada Acara Ditolak</h2>
                        </div>
                        <div style="background-color: #fff8e1;" class="p-3 rounded-circle text-warning">
                            <i class="fas fa-exclamation-circle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                    <h6 class="fw-bold mb-0"><i class="fas fa-rocket text-primary me-2"></i> Akses Cepat Panitia</h6>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <a href="{{ route('events.create') }}" class="btn btn-outline-primary w-100 py-3 px-4 text-start d-flex align-items-center h-100" style="border-radius: 12px;">
                                <i class="fas fa-plus-circle fa-2x me-3"></i>
                                <div>
                                    <span class="fw-bold d-block">Ajukan Acara</span>
                                    <small class="text-muted" style="font-size: 0.75rem;">Ajukan acara baru yang ingin diadakan</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a href="{{ route('participants.index') }}" class="btn btn-outline-secondary w-100 py-3 px-4 text-start d-flex align-items-center h-100" style="border-radius: 12px;">
                                <i class="fas fa-users-cog fa-2x me-3 text-primary"></i>
                                <div>
                                    <span class="fw-bold d-block text-dark">Kelola Peserta</span>
                                    <small class="text-muted" style="font-size: 0.75rem;">Cek antrean & kuota</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 bg-primary text-white text-center p-4 d-flex justify-content-center align-items-center" style="border-radius: 15px; background-image: linear-gradient(135deg, var(--primary-color), #2b7cb7);">
                <i class="fas fa-lightbulb fa-3x mb-3 text-white" style="opacity: 0.8;"></i>
                <h5 class="fw-bold mb-2">Tips NexEvent</h5>
                <p class="small mb-0" style="opacity: 0.85;">
                    Pastikan proposal PDF dan poster yang diunggah beresolusi tinggi agar cepat di-ACC oleh pihak Kampus.
                </p>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection