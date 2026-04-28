@extends('layouts.app')

@section('title', 'Dashboard Superadmin')

@section('content')
<div class="container-fluid p-0">

    <div class="card border-0 shadow-sm mb-4 text-white" style="background-image: linear-gradient(135deg, var(--primary-color), #2b7cb7); border-radius: 15px;">
        <div class="card-body p-4 d-flex align-items-center">
            <i class="fas fa-university fa-3x me-4" style="opacity: 0.8;"></i>
            <div>
                <h4 class="fw-bold mb-1">Selamat Datang, {{ Auth::user()->name }}! 🎓</h4>
                <p class="mb-0" style="opacity: 0.85;">Pantau seluruh aktivitas HIMA/UKM, perizinan acara, dan pendaftar di platform NexEvent.</p>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100" style="border-left: 5px solid #ffc107 !important;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted text-uppercase fw-bold mb-1" style="font-size: 0.8rem;">Antrean Review</p>
                            <h2 class="fw-bold mb-0 text-dark">{{ $totalPending }} <span class="fs-6 text-muted fw-normal">Proposal</span></h2>
                        </div>
                        <div class="bg-warning bg-opacity-10 p-3 rounded-circle text-warning">
                            <i class="fas fa-file-signature fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100" style="border-left: 5px solid var(--primary-color) !important;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted text-uppercase fw-bold mb-1" style="font-size: 0.8rem;">Organisasi Terdaftar</p>
                            <h2 class="fw-bold mb-0 text-dark">{{ $totalOrgs }} <span class="fs-6 text-muted fw-normal">HIMA/UKM</span></h2>
                        </div>
                        <div class="p-3 rounded-circle" style="background-color: #e0f0ff; color: #46A0E5;">
                            <i class="fas fa-building fa-2x"></i>
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
                            <p class="text-muted text-uppercase fw-bold mb-1" style="font-size: 0.8rem;">Total Acara Kampus</p>
                            <h2 class="fw-bold mb-0 text-dark">{{ $totalEvents }} <span class="fs-6 text-muted fw-normal">Acara</span></h2>
                        </div>
                        <div class="bg-success bg-opacity-10 p-3 rounded-circle text-success">
                            <i class="fas fa-calendar-check fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom-0">
            <h6 class="fw-bold mb-0 text-dark"><i class="fas fa-bell text-warning me-2"></i>Butuh Tindakan Cepat (Pending)</h6>
            <a href="{{ route('superadmin.events') }}" class="btn btn-sm btn-outline-primary">Lihat Semua Antrean</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Penyelenggara</th>
                            <th>Judul Acara</th>
                            <th>Tanggal Diajukan</th>
                            <th class="text-center pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendingEvents as $event)
                        <tr>
                            <td class="ps-4 fw-bold text-primary">{{ $event->user->name }}</td>
                            <td>{{ $event->title }}</td>
                            <td>{{ \Carbon\Carbon::parse($event->created_at)->diffForHumans() }}</td>
                            <td class="text-center pe-4">
                                <a href="{{ route('superadmin.event.detail', $event->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-search me-1"></i> Review Proposal
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">
                                <i class="fas fa-check-circle fa-2x text-success mb-2 opacity-50 d-block"></i>
                                Hebat! Tidak ada proposal acara yang mengantre.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection