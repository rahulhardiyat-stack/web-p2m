@extends('layouts.frontend')

@push('title')
{{ __('menu.curriculum') }} -
@endpush

{{--@section('content')
<section class="page-header-premium mb-0">
    <div class="page-header-pattern"></div>
    <div class="page-header-logo">
        <img src="{{ asset('storage/' . \App\Models\Setting::get('site_logo')) }}" alt="Logo">
    </div>
    <div class="container position-relative z-10 py-5">
        <div class="row align-items-center">
            <div class="col-lg-12 text-center" data-aos="fade-up">
                <nav aria-label="breadcrumb" class="d-flex justify-content-center mb-3">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.home') }}</a></li>
                        <li class="breadcrumb-item active text-white-50" aria-current="page">{{ __('menu.curriculum') }}</li>
                    </ol>
                </nav>
                <h1 class="display-3 fw-bold text-white mb-3">
                    {{ __('menu.curriculum') }}
                </h1>
                <p class="lead text-white-50 mx-auto" style="max-width: 800px;">
                    {{ __('Struktur kurikulum dirancang untuk membekali mahasiswa dengan kompetensi yang relevan dengan kebutuhan industri dan perkembangan teknologi terkini.') }}
                </p>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center" data-aos="fade-up">
                <div class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-2 mb-3">
                    <i class="fas fa-book-open me-1"></i> Sebaran Mata Kuliah
                </div>
                <h2 class="fw-bold text-dark mb-4">Struktur Mata Kuliah Per Semester</h2>
                <p class="text-secondary">Klik pada tab semester untuk melihat daftar mata kuliah yang ditawarkan.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-12" data-aos="fade-up">
                --}}{{-- Semester Tabs --}}{{--
                <ul class="nav nav-pills nav-fill mb-4 p-2 bg-white rounded-pill shadow-sm border" id="curriculumTabs" role="tablist">
                    @foreach($curriculums as $semester => $items)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill fw-bold py-3 {{ $loop->first ? 'active' : '' }}"
                                    id="semester-{{ $semester }}-tab"
                                    data-bs-toggle="pill"
                                    data-bs-target="#semester-{{ $semester }}"
                                    type="button" role="tab">
                                SEMESTER {{ $semester }}
                            </button>
                        </li>
                    @endforeach
                </ul>

                --}}{{-- Tab Content --}}{{--
                <div class="tab-content" id="curriculumTabsContent">
                    @foreach($curriculums as $semester => $items)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                             id="semester-{{ $semester }}"
                             role="tabpanel">

                            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="bg-primary text-white">
                                            <tr>
                                                <th class="ps-4 py-4" style="width: 100px;">Kode</th>
                                                <th class="py-4">Mata Kuliah</th>
                                                <th class="py-4 text-center" style="width: 80px;">SKS</th>
                                                <th class="py-4">Tipe</th>
                                                <th class="py-4">Konsentrasi</th>
                                                <th class="pe-4 py-4 text-center" style="width: 150px;">RPS / Silabus</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($items as $course)
                                                <tr>
                                                    <td class="ps-4 py-3 fw-bold text-primary">{{ $course->code }}</td>
                                                    <td class="py-3">
                                                        <div class="fw-bold text-dark">{{ $course->name }}</div>
                                                        @if($course->description)
                                                            <small class="text-muted d-block mt-1">{{ Str::limit($course->description, 100) }}</small>
                                                        @endif
                                                    </td>
                                                    <td class="py-3 text-center fw-bold">{{ $course->credits }}</td>
                                                    <td class="py-3 text-capitalize">
                                                        <span class="badge {{ $course->type == 'wajib' ? 'bg-info' : 'bg-secondary' }} rounded-pill px-3 py-2">
                                                            {{ $course->type }}
                                                        </span>
                                                    </td>
                                                    <td class="py-3">
                                                        {{ $course->concentration ?: '-' }}
                                                    </td>
                                                    <td class="pe-4 py-3 text-center">
                                                        @if($course->rps_file)
                                                            <a href="{{ asset('storage/' . $course->rps_file) }}" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                                                <i class="fas fa-download me-1"></i> PDF
                                                            </a>
                                                        @else
                                                            <span class="text-muted small italic">N/A</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot class="bg-light">
                                            <tr>
                                                <td colspan="2" class="ps-4 py-3 fw-bold text-dark">Total SKS Semester {{ $semester }}</td>
                                                <td class="py-3 text-center fw-bold text-primary" style="font-size: 1.1rem;">
                                                    {{ $items->sum('credits') }}
                                                </td>
                                                <td colspan="3"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-12 text-center" data-aos="fade-up">
                <div class="card border-0 shadow-lg rounded-4 p-5 bg-navy-gradient text-white position-relative overflow-hidden">
                    <div class="position-absolute top-0 end-0 p-4 opacity-10">
                        <i class="fas fa-graduation-cap fa-10x"></i>
                    </div>
                    <h3 class="fw-bold mb-3">Butuh Informasi Lebih Lanjut?</h3>
                    <p class="lead mb-4 opacity-75">Detail mengenai mata kuliah prasyarat, kompetensi lulusan, dan panduan akademik lengkap dapat dilihat di Buku Panduan Akademik.</p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('academic') }}" class="btn btn-gold btn-lg rounded-pill px-5 shadow">
                            <i class="fas fa-book me-2"></i> Panduan Akademik
                        </a>
                        <a href="{{ route('contact.index') }}" class="btn btn-outline-light btn-lg rounded-pill px-5">
                            Hubungi Prodi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .bg-primary-subtle { background-color: rgba(0, 180, 216, 0.1); }
    .border-primary-subtle { border-color: rgba(0, 180, 216, 0.2) !important; }

    .bg-navy-gradient {
        background: linear-gradient(135deg, #0a192f 0%, #112240 100%);
    }

    #curriculumTabs .nav-link {
        color: #64748b;
        border: none;
        transition: all 0.3s ease;
    }

    #curriculumTabs .nav-link.active {
        background: linear-gradient(135deg, #0056b3 0%, #00b4d8 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(0, 180, 216, 0.3);
    }

    .table thead th {
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.85rem;
        border: none;
    }

    .table tbody tr {
        transition: all 0.2s ease;
    }

    .table tbody tr:hover {
        background-color: rgba(0, 86, 179, 0.02) !important;
    }

    .btn-gold {
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        color: #0c1c38;
        border: none;
        font-weight: 700;
    }

    .btn-gold:hover {
        background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
        color: #0c1c38;
        transform: translateY(-2px);
    }
</style>
@endpush--}}



@section('content')
    <div class="lecturers-page">

        <section class="page-header-premium mb-0">
            <div class="page-header-pattern"></div>
            <div class="page-header-logo">
                <img src="{{ asset('storage/' . \App\Models\Setting::get('site_logo')) }}" alt="Logo">
            </div>
            <div class="container position-relative z-10 py-5">
                <div class="row align-items-center">
                    <div class="col-lg-12 text-center" data-aos="fade-up">
                        <nav aria-label="breadcrumb" class="d-flex justify-content-center mb-3">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('menu.home') }}</a></li>
                                <li class="breadcrumb-item active text-white-50" aria-current="page">{{ __('menu.curriculum') }}</li>
                            </ol>
                        </nav>
                        <h1 class="display-3 fw-bold text-white mb-3">
                            {{ __('menu.curriculum') }}
                        </h1>
                        <p class="lead text-white-50 mx-auto" style="max-width: 800px;">
                            {{ __('Struktur kurikulum dirancang untuk membekali mahasiswa dengan kompetensi yang relevan dengan kebutuhan industri dan perkembangan teknologi terkini.') }}
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{--Tab Curriculum--}}
        <section class="pt-0 pb-5 bg-light">
            <div class="container">
                <!-- Tabs for Dosen and Tendik -->
                <ul class="nav nav-pills nav-justified mb-2 shadow-sm rounded-4 bg-white p-2" id="staffTab" role="tablist" data-aos="fade-up">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active rounded-4 fw-bold py-3" id="dosen-tab" data-bs-toggle="pill" data-bs-target="#dosen" type="button" role="tab" aria-controls="dosen" aria-selected="true">
                            <i class="fas fa-chalkboard-teacher me-2"></i> {{ __('Struktur Mata Kuliah') }}
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-4 fw-bold py-3" id="tendik-tab" data-bs-toggle="pill" data-bs-target="#tendik" type="button" role="tab" aria-controls="tendik" aria-selected="false">
                            <i class="fas fa-user-cog me-2"></i> {{ __('Kuliah tamu') }}
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-4 fw-bold py-3" id="tendik-tab" data-bs-toggle="pill" data-bs-target="#pengembangan-kur" type="button" role="tab" aria-controls="tendik" aria-selected="false">
                            <i class="fas fa-user-cog me-2"></i> {{ __('kegiatan pengembangan kurikulum') }}
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
                                    <label for="lecturer-search" class="form-label small fw-bold text-muted text-uppercase letter-spacing-1">Cari Nama MataKuliah</label>
                                    <div class="input-group shadow-sm">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fas fa-search text-success"></i>
                                    </span>
                                        <input type="search" id="lecturer-search" name="q" class="form-control border-start-0" placeholder="Ketik kata kunci..." value="{{ request('q') }}">
                                    </div>
                                </div>

                                <!-- Select Homebase -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="lecturer-homebase" class="form-label small fw-bold text-muted text-uppercase letter-spacing-1">Prodi</label>
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

                                {{-- <div class="col-md-4 d-grid">
                                     <button type="submit" class="btn btn-success btn-sm rounded-pill py-1 shadow-sm">
                                         <i class="fas fa-filter me-2 text-white"></i> Filter
                                     </button>
                                 </div>--}}
                                @if(request('q') || request('p'))
                                    <div class="col-12 mt-2">
                                        <a href="{{ route('curriculum') }}" class="text-danger small fw-bold text-decoration-none">
                                            <i class="fas fa-times-circle me-1"></i> Reset Filter
                                        </a>
                                    </div>
                                @endif
                            </form>
                        </div>
                        {{--data dosen--}}
                        <div class="tab-content" id="curriculumTabsContent">
                            @foreach($curriculums as $semester => $items)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                     id="semester-{{ $semester }}"
                                     role="tabpanel">

                                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                                        <div class="table-responsive">
                                            <table class="table table-hover align-middle mb-0">
                                                <thead class="bg-primary text-white">
                                                <tr>
                                                    <th class="ps-4 py-4" style="width: 100px;">Kode</th>
                                                    <th class="py-4">Mata Kuliah</th>
                                                    <th class="py-4 text-center" style="width: 80px;">SKS</th>
                                                    <th class="py-4">Tipe</th>
                                                    <th class="py-4">Konsentrasi</th>
                                                    <th class="pe-4 py-4 text-center" style="width: 150px;">RPS / Silabus</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($items as $course)
                                                    <tr>
                                                        <td class="ps-4 py-3 fw-bold text-primary">{{ $course->code }}</td>
                                                        <td class="py-3">
                                                            <div class="fw-bold text-dark">{{ $course->name }}</div>
                                                            @if($course->description)
                                                                <small class="text-muted d-block mt-1">{{ Str::limit($course->description, 100) }}</small>
                                                            @endif
                                                        </td>
                                                        <td class="py-3 text-center fw-bold">{{ $course->credits }}</td>
                                                        <td class="py-3 text-capitalize">
                                                        <span class="badge {{ $course->type == 'wajib' ? 'bg-info' : 'bg-secondary' }} rounded-pill px-3 py-2">
                                                            {{ $course->type }}
                                                        </span>
                                                        </td>
                                                        <td class="py-3">
                                                            {{ $course->concentration ?: '-' }}
                                                        </td>
                                                        <td class="pe-4 py-3 text-center">
                                                            @if($course->rps_file)
                                                                <a href="{{ asset('storage/' . $course->rps_file) }}" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                                                    <i class="fas fa-download me-1"></i> PDF
                                                                </a>
                                                            @else
                                                                <span class="text-muted small italic">N/A</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot class="bg-light">
                                                <tr>
                                                    <td colspan="2" class="ps-4 py-3 fw-bold text-dark">Total SKS Semester {{ $semester }}</td>
                                                    <td class="py-3 text-center fw-bold text-primary" style="font-size: 1.1rem;">
                                                        {{ $items->sum('credits') }}
                                                    </td>
                                                    <td colspan="3"></td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Tendik Tab -->
                    <div class="tab-pane fade" id="tendik" role="tabpanel" aria-labelledby="tendik-tab">
                        <div class="row g-4">
                            <p>Data Kuliah Tamu Kosong</p>
                            {{--@forelse($curriculums as $cur => $item)
                                <div class="col-md-6 col-lg-3">
                                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden transition-hover">
                                        <div class="position-relative">
                                            <div class="position-absolute bottom-0 start-0 w-100 p-3 bg-gradient-dark text-white">
                                                <h6 class="fw-bold mb-0">{{ $item->name }}</h6>
                                            </div>
                                        </div>
                                        <div class="card-body p-3 text-center">
                                            <p class="text-primary small fw-bold mb-0">{{ __('Staf') }}</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center py-5">
                                    <p class="text-muted">{{ __('Data tenaga kependidikan belum tersedia.') }}</p>
                                </div>
                            @endforelse--}}
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pengembangan-kur" role="tabpanel" aria-labelledby="tendik-tab">
                        <div class="row g-4">
                            <p>Data Kegiatan Kosong</p>
                            {{--@forelse($curriculums as $cur => $item)
                                <div class="col-md-6 col-lg-3">
                                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden transition-hover">
                                        <div class="position-relative">
                                            <div class="position-absolute bottom-0 start-0 w-100 p-3 bg-gradient-dark text-white">
                                                <h6 class="fw-bold mb-0">{{ $item->name }}</h6>
                                            </div>
                                        </div>
                                        <div class="card-body p-3 text-center">
                                            <p class="text-primary small fw-bold mb-0">{{ __('Staf') }}</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center py-5">
                                    <p class="text-muted">{{ __('Data tenaga kependidikan belum tersedia.') }}</p>
                                </div>
                            @endforelse--}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('styles')
    <style>

        /* Mengubah warna background tab yang aktif */
        .nav-pills .nav-link.active,
        .nav-pills .show > .nav-link {
            background-color: #117b4b !important; /* Ganti dengan kode warna yang diinginkan */
            color: #ffffff !important; /* Warna teks */
        }
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
