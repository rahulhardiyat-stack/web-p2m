@extends('layouts.frontend')

@push('title')
{{ __('Dosen & Tenaga Kependidikan') }} -
@endpush

@section('content')
<div class="lecturers-page">
<div class="page-header-premium lecturers-header py-5 text-white position-relative overflow-hidden">
    <div class="page-header-pattern"></div>
    <div class="container position-relative lecturers-header-content">
        <div class="row align-items-center">
            <div class="col-lg-8" data-aos="fade-up">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2 text-white-50">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">{{ __('Beranda') }}</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">{{ __('Dosen & Tendik') }}</li>
                    </ol>
                </nav>
                <h1 class="display-4 fw-bold mb-0">{{ __('Dosen & Tendik') }}</h1>
                <p class="lead mb-0 text-white-50 mt-2">{{ __('Mengenal lebih dekat para pengajar dan staf profesional kami.') }}</p>
            </div>
        </div>
    </div>
    <div class="page-header-logo">
        @php $logo = \App\Models\Setting::get('site_logo') @endphp
        @if($logo)
            <img src="{{ asset('storage/'.$logo) }}" alt="Logo">
        @endif
    </div>
</div>

{{--infografis data dosen--}}
<section class="lecturers-statistics py-4 py-lg-5 bg-light">
        <div class="container">
            <div class="statistics-panel shadow-sm rounded-4 bg-white p-3 p-md-4">
            <!-- Section Header -->
            <div class="text-center mb-4">
                <h2 class="fw-bold text-success">Statistik Dosen & Pengajar</h2>
                <p class="text-muted">Ringkasan data tenaga pendidik berdasarkan kualifikasi dan jabatan akademik.</p>
            </div>

            <!-- Infographics Grid -->
            <div class="row g-3 justify-content-center">
                @php
                    // Contoh array data, nantinya ini bisa dipassing dari Controller, misal: $statistikDosen
                    $statistikDosen = [
                        ['label' => 'Total Dosen', 'value' => 107, 'icon' => 'fa-users', 'color' => 'primary'],
                        ['label' => 'Asisten Ahli', 'value' => 0, 'icon' => 'fa-user-graduate', 'color' => 'warning'],
                        ['label' => 'Lektor', 'value' => 0, 'icon' => 'fa-user-tie', 'color' => 'info'],
                        ['label' => 'Lektor Kepala', 'value' => 0, 'icon' => 'fa-chalkboard-teacher', 'color' => 'success'],
                        ['label' => 'Magister (S2)', 'value' => 0, 'icon' => 'fa-book-reader', 'color' => 'secondary'],
                        ['label' => 'Doktor (S3)', 'value' => 0, 'icon' => 'fa-award', 'color' => 'danger'],
                    ];
                @endphp

                @foreach($statistikDosen as $index => $stat)
                    <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                        <div class="card border-0 shadow-sm text-center h-100 py-3 rounded-4 stat-card-hover">
                            <div class="card-body">
                                <!-- Ikon -->
                                <div class="icon-box bg-{{ $stat['color'] }} bg-opacity-10 text-{{ $stat['color'] }} rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 65px; height: 65px; font-size: 28px;">
                                    <i class="fas {{ $stat['icon'] }}"></i>
                                </div>

                                <!-- Angka & Label -->
                                <h3 class="fw-bold mb-1 counter-value" data-target="{{ $stat['value'] }}">{{ $stat['value'] }}</h3>
                                <p class="text-muted small mb-0 fw-semibold text-uppercase" style="letter-spacing: 0.5px; font-size: 0.75rem;">
                                    {{ $stat['label'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<section class="pt-0 pb-5 bg-light">
    <div class="container">
        <!-- Tabs for Dosen and Tendik -->
        <ul class="nav nav-pills nav-justified mb-2 shadow-sm rounded-4 bg-white p-2" id="staffTab" role="tablist" data-aos="fade-up">
            <li class="nav-item" role="presentation">
                <button class="nav-link active rounded-4 fw-bold py-3" id="dosen-tab" data-bs-toggle="pill" data-bs-target="#dosen" type="button" role="tab" aria-controls="dosen" aria-selected="true">
                    <i class="fas fa-chalkboard-teacher me-2"></i> {{ __('Dosen / Pengajar') }}
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link rounded-4 fw-bold py-3" id="tendik-tab" data-bs-toggle="pill" data-bs-target="#tendik" type="button" role="tab" aria-controls="tendik" aria-selected="false">
                    <i class="fas fa-user-cog me-2"></i> {{ __('Tenaga Kependidikan') }}
                </button>
            </li>
        </ul>

        <div class="tab-content" id="staffTabContent">
            <!-- Dosen Tab -->
            <div class="tab-pane fade show active" id="dosen" role="tabpanel" aria-labelledby="dosen-tab">
                {{--Filter Bar--}}
                <div class="filter-card shadow-sm mb-4 p-3 p-md-4 rounded-4 bg-white border border-light">
                    <form action="{{ route('lecturers.index') }}" method="GET" class="row g-3 align-items-end">
                            <!-- Input Pencarian -->
                            <div class="col-12 col-md-6 col-lg-5">
                                <label for="lecturer-search" class="form-label small fw-bold text-muted text-uppercase letter-spacing-1">Cari Dosen</label>
                                <div class="input-group shadow-sm">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fas fa-search text-success"></i>
                                    </span>
                                    <input type="search" id="lecturer-search" name="q" class="form-control border-start-0" placeholder="Ketik kata kunci..." value="{{ request('q') }}">
                                </div>
                            </div>

                            <!-- Select Homebase -->
                            <div class="col-12 col-md-6 col-lg-4">
                                <label for="lecturer-homebase" class="form-label small fw-bold text-muted text-uppercase letter-spacing-1">Homebase</label>
                                <select id="lecturer-homebase" name="p" class="form-select shadow-sm select-year">
                                    <option value="">--Prodi--</option>
                                    <option value="Dosen-PAI" @selected(request('p') === 'Dosen-PAI')>Pendidikan Agama Islam</option>
                                    <option value="Dosen-PGM" @selected(request('p') === 'Dosen-PGM')>Pendidikan Guru Madrasah Ibtidaiyah</option>
                                    <option value="Dosen-TBI" @selected(request('p') === 'Dosen-TBI')>Tadris Bahasa Inggris</option>
                                    <option value="Dosen-MPI" @selected(request('p') === 'Dosen-MPI')>Manajemen Pendidikan Islam</option>
                                    <option value="Dosen-PBA" @selected(request('p') === 'Dosen-PBA')>Pendidikan Bahasa Arab</option>
                                    <option value="Dosen-KPI" @selected(request('p') === 'Dosen-KPI')>Komunikasi Penyiaran Islam</option>
                                    <option value="Dosen-PMI" @selected(request('p') === 'Dosen-PMI')>Pengembangan Masyarakat Islam</option>
                                    <option value="Dosen-IAT" @selected(request('p') === 'Dosen-IAT')>Ilmu Al-Qur'an dan Hadist</option>
                                    <option value="Dosen-HPI" @selected(request('p') === 'Dosen-HPI')>Hukum Pidana Islam</option>
                                    <option value="Dosen-HES" @selected(request('p') === 'Dosen-HES')>Hukum Ekonomi Islam</option>
                                    <option value="Dosen-PSY" @selected(request('p') === 'Dosen-PSY')>Perbankan Syariah</option>
                                    <option value="Dosen-HTN" @selected(request('p') === 'Dosen-HTN')>Hukum Tata Negara</option>
                                    <option value="Dosen-MPD" @selected(request('p') === 'Dosen-MPD')>Manajemen Pendidikan Islam (S2)</option>
                                    <option value="Dosen-MSI" @selected(request('p') === 'Dosen-MSI')>Ekonomi Syariah (S2)</option>
                                    <option value="Dosen-MES" @selected(request('p') === 'Dosen-MES')>Studi Islam (S2)</option>
                                </select>
                            </div>

                            <!-- Tombol Filter -->
                            <div class="col-12 col-lg-3">
                                <button type="submit" class="btn btn-success rounded-pill py-2 px-4 shadow-sm w-100">
                                    <i class="fas fa-filter me-2 text-white"></i> Filter Data
                                </button>
                            </div>
                        {{--SK Homebase--}}
                        <div class="col-12 d-flex justify-content-center align-items-center">
                            <a href="https://drive.google.com/file/d/1qj4tx5BSSM8QSHcIB2Xw13zt1EbuXvQv/view?usp=sharing"
                               target="_blank" rel="noopener noreferrer"
                               class="btn btn-light border rounded-3 d-inline-flex align-items-center gap-2 homebase-document">
                                <i class="fas fa-file-pdf text-danger" aria-hidden="true"></i>
                                <span>SK Homebase Dosen</span>
                            </a>
                        </div>

                       {{-- <div class="col-md-4 d-grid">
                            <button type="submit" class="btn btn-success btn-sm rounded-pill py-1 shadow-sm">
                                <i class="fas fa-filter me-2 text-white"></i> Filter
                            </button>
                        </div>--}}
                        @if(request('q') || request('p'))
                            <div class="col-12 mt-2">
                                <a href="{{ route('lecturers.index') }}" class="text-danger small fw-bold text-decoration-none">
                                    <i class="fas fa-times-circle me-1"></i> Reset Filter
                                </a>
                            </div>
                        @endif
                    </form>
                </div>

                {{--data dosen--}}
                <div class="table-responsive lecturers-table-wrapper shadow-sm rounded-4 border-0">
                    <table class="table table-hover align-middle mb-0 custom-datatable lecturers-table">
                        <thead class="bg-success bg-gradient text-white">
                        <tr>
                            <th class="px-4 py-4 text-center">No</th>
                            <th class="px-4 py-4" style="width: 35%;">Nama Dosen</th>
                            <th class="py-4">Jabatan</th>
                            <th class="py-4 text-center">Homebase</th>
                            <th class="px-4 py-4 text-end">Aksi</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white">
                        @forelse($dosen as $item)
                            <tr>
                                <td class="px-4 py-3 text-center lecturer-number">
                                    <span>{{ $dosen->firstItem() + $loop->index }}</span>
                                </td>
                                <td class="px-4 py-3 lecturer-identity">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $item->photo_url }}" class="lecturer-avatar" alt="{{ $item->name }}" loading="lazy">
                                        <div class="text-dark fw-bold" style="font-size: 0.95rem; line-height: 1.4;">
                                            {{ $item->name }}
                                            <div style="color: gray; font-size: 0.75rem; font-weight: normal;">
                                                {{ $item->nip }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 lecturer-detail" data-label="Jabatan">
                                    <span class="text-secondary small d-block"><i class="fas fa-user-circle me-2 opacity-50"></i>{{ $item->academic_title ?? 'Tutor/Dosen' }}</span>
                                </td>
                                <td class="py-3 text-center lecturer-detail" data-label="Homebase">
                            <span class="badge bg-soft-success px-3 py-2 rounded-pill text-success fw-bold" style="font-size: 0.8rem;">
                                {{ $item->position ?? '-' }}
                            </span>
                                </td>
                                <td class="px-4 py-3 text-end lecturer-action">
                                    <a href="{{ route('lecturers.show', $item->id) }}" class="btn btn-outline-primary btn-sm w-100 rounded-pill">{{ __('Lihat Profil') }}</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="py-4">
                                        <i class="fas fa-database fa-3x text-muted opacity-20 mb-3"></i>
                                        <h5 class="text-muted fw-bold">Tidak ada data dosen ditemukan.</h5>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="lecturers-pagination mt-4 d-flex justify-content-center">
                    {{ $dosen->withQueryString()->links() }}
                </div>

            </div>

            {{--old_dosen tab--}}
           {{-- <div class="tab-pane fade show active" id="dosen" role="tabpanel" aria-labelledby="dosen-tab">
                <div class="row g-4">
                    @forelse($dosen as $item)
                    <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="{{ $loop->iteration * 50 }}">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden transition-hover">
                            <div class="position-relative">
                                <img src="{{ $item->photo_url }}" class="card-img-top" alt="{{ $item->name }}" style="height: 300px; object-fit: cover;">
                                <div class="position-absolute bottom-0 start-0 w-100 p-3 bg-gradient-dark text-white">
                                    <h6 class="fw-bold mb-0">{{ $item->name }}</h6>
                                    <small class="opacity-75">{{ $item->academic_title }}</small>
                                </div>
                            </div>
                            <div class="card-body p-3">
                                <p class="text-primary small fw-bold mb-2"><i class="fas fa-briefcase me-1"></i> {{ $item->position ?? __('Dosen') }}</p>
                                <div class="text-secondary small mb-3">
                                    <i class="fas fa-microscope me-1"></i> {{ \Illuminate\Support\Str::limit($item->expertise, 50) }}
                                </div>
                                <a href="{{ route('lecturers.show', $item->id) }}" class="btn btn-outline-primary btn-sm w-100 rounded-pill">{{ __('Lihat Profil') }}</a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">{{ __('Data dosen belum tersedia.') }}</p>
                    </div>
                    @endforelse
                </div>
            </div>--}}

            <!-- Tendik Tab -->
            <div class="tab-pane fade" id="tendik" role="tabpanel" aria-labelledby="tendik-tab">
                <div class="row g-4">
                    @forelse($tendik as $item)
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden transition-hover">
                            <div class="position-relative">
                                <img src="{{ $item->photo_url }}" class="card-img-top" alt="{{ $item->name }}" style="height: 300px; object-fit: cover;">
                                <div class="position-absolute bottom-0 start-0 w-100 p-3 bg-gradient-dark text-white">
                                    <h6 class="fw-bold mb-0">{{ $item->name }}</h6>
                                </div>
                            </div>
                            <div class="card-body p-3 text-center">
                                <p class="text-primary small fw-bold mb-0">{{ $item->position ?? __('Staf') }}</p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">{{ __('Data tenaga kependidikan belum tersedia.') }}</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
</div>
@endsection

@push('styles')
<style>
    .rotate-n-15 { transform: rotate(-15deg); }
    .transition-hover { transition: all 0.3s ease; }
    .transition-hover:hover { transform: translateY(-5px); box-shadow: 0 1rem 2rem rgba(0,0,0,0.1) !important; }
    .bg-gradient-dark {
        background: linear-gradient(0deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 100%);
    }
    .lecturers-page .nav-pills .nav-link.active {
        background-color: var(--bs-primary);
        color: white;
    }
    .lecturers-page .nav-pills .nav-link {
        color: var(--bs-secondary);
    }


         /* Efek melayang (hover) pada card statistik */
     .stat-card-hover {
         transition: transform 0.3s ease, box-shadow 0.3s ease;
     }
    .stat-card-hover:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    /* Opsional: memastikan letter-spacing rapi */
    .letter-spacing-1 {
        letter-spacing: 1px;
    }

    .lecturers-page .lecturers-header { padding-bottom: 4rem !important; }
    .lecturers-header-content { z-index: 1; }
    .statistics-panel { position: relative; margin-top: -3rem; z-index: 2; }
    .lecturers-page #staffTab .nav-item { min-width: 0; }
    .lecturers-page #staffTab .nav-link { height: 100%; width: 100%; }
    .lecturers-page .form-control, .lecturers-page .form-select { min-height: 44px; }
    .lecturers-page .input-group > .form-control { min-width: 0; }
    .lecturers-table { width: 100%; }
    .lecturers-table th { white-space: nowrap; }
    .lecturers-table td { overflow-wrap: anywhere; }
    .lecturers-table .badge { white-space: normal; line-height: 1.5; }
    .lecturer-identity .d-flex > .text-dark { min-width: 0; }
    .lecturer-avatar { width: 60px; height: 60px; object-fit: cover; border-radius: 50%; flex-shrink: 0; margin-right: 12px; }
    .lecturer-action .btn { min-width: 110px; }
    .lecturers-pagination { min-width: 0; }
    .lecturers-pagination nav { max-width: 100%; }
    .lecturers-pagination .pagination { flex-wrap: wrap; gap: 4px; }
    .homebase-document { max-width: 100%; white-space: normal; }

    @media (max-width: 991.98px) {
        .lecturers-page .stat-card-hover .card-body { padding: 1rem 0.5rem; }
    }

    @media (max-width: 767.98px) {
        .lecturers-page .lecturers-header { padding-top: 2rem !important; padding-bottom: 3rem !important; }
        .statistics-panel { margin-top: -2rem; }
        .lecturers-page #staffTab .nav-link { padding: 0.75rem 0.5rem !important; font-size: 0.8rem; }
        .lecturers-page #staffTab .nav-link i { display: block; margin: 0 0 0.5rem !important; }
        .lecturers-page .statistics-panel h2 { font-size: 1.25rem; }
        .lecturers-page .statistics-panel > .text-center p { font-size: 0.875rem; }
        .lecturers-table-wrapper { overflow: visible; box-shadow: none !important; }
        .lecturers-table, .lecturers-table tbody { display: block; background: transparent !important; }
        .lecturers-table thead { position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip-path: inset(50%); white-space: nowrap; }
        .lecturers-table tbody tr { display: block; padding: 1rem; margin-bottom: 1rem; background: var(--bs-body-bg, #fff); border: 1px solid var(--bs-border-color, #dee2e6); border-radius: 1rem; }
        .lecturers-table tbody td { display: block; width: 100%; padding: 0.5rem 0 !important; border: 0; box-shadow: none; background: transparent; text-align: left !important; }
        .lecturers-table .lecturer-number { display: none; }
        .lecturers-table .lecturer-identity { padding-top: 0 !important; padding-bottom: 1rem !important; }
        .lecturers-table .lecturer-detail { display: flex; align-items: flex-start; gap: 0.75rem; }
        .lecturers-table .lecturer-detail::before { content: attr(data-label); flex: 0 0 5rem; font-size: 0.8rem; font-weight: 600; color: var(--bs-secondary-color, #6c757d); }
        .lecturers-table .lecturer-detail > * { min-width: 0; }
        .lecturers-table .lecturer-action { padding-bottom: 0 !important; }
        .lecturers-page #tendik .card-img-top { height: clamp(240px, 70vw, 360px) !important; }
    }
</style>
@endpush

@push('scripts')
<script>
    // Counter Animation for Infographics
    const counters = document.querySelectorAll('.counter-value');
    const speed = 200;

    const runCounter = () => {
        counters.forEach(counter => {
            const updateCount = () => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const inc = target / speed;

                if (count < target) {
                    counter.innerText = Math.ceil(count + inc);
                    setTimeout(updateCount, 1);
                } else {
                    counter.innerText = target.toLocaleString();
                }
            };
            updateCount();
        });
    };
</script>
@endpush
