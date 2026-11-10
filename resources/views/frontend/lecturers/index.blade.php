@extends('layouts.frontend')

@push('title')
{{ __('Dosen & Tenaga Kependidikan') }} -
@endpush

@section('content')
<div class="page-header-premium py-5 text-white position-relative overflow-hidden">
    <div class="page-header-pattern"></div>
    <div class="container py-4 position-relative z-1">
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

{{--SK Homebase--}}
{{--<div class="p-3">
    <a href="https://drive.google.com/file/d/1qj4tx5BSSM8QSHcIB2Xw13zt1EbuXvQv/view?usp=sharing"
       target="_blank"
       style="text-decoration: none !important;"
       class="inline-flex items-center gap-2.5 px-5 py-2.5 bg-gray-50 !text-gray-700 font-medium text-sm rounded-xl border border-gray-200 hover:bg-gray-700 hover:!text-white hover:border-transparent transition-all duration-200 ease-in-out shadow-sm hover:shadow-md no-underline">
        <i class="fas fa-file-pdf text-base text-red-500 group-hover:!text-white"></i>
        <span style="color: #374151 !important;">SK Homebase Dosen</span>
    </a>
</div>--}}

<section class="py-5 bg-light">
    <div class="container">
        <!-- Tabs for Dosen and Tendik -->
        <ul class="nav nav-pills nav-justified mb-5 shadow-sm rounded-4 bg-white p-2" id="staffTab" role="tablist" data-aos="fade-up">
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
                <div class="filter-card shadow-sm mb-5 p-4 rounded-4 bg-white border border-ligh">
                    <form action="{{ route('lecturers.index') }}" method="GET" class="row g-3 justify-content-end">
                        <div class="d-flex gap-2 justify-content-end align-items-end col-md-6">
                            <div class="col-md-12 ms-auto">
                                <label class="form-label small fw-bold text-muted text-uppercase letter-spacing-1">Cari Dosen/Homebase</label>
                                <div class="input-group search-group flex-grow-1">
                                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-success"></i></span>
                                    <input type="text" name="q" class="form-control border-start-0" placeholder="Ketik kata kunci..." value="{{ request('q') }}">
                                    <div class="px-2">
                                        <button type="submit" class="btn btn-success btn-sm rounded-pill py-2 shadow-sm">
                                            <i class="fas fa-filter me-2 text-white"></i> Filter Data
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                       {{-- <div class="col-md-3">
                            <label class="form-label small fw-bold text-muted text-uppercase letter-spacing-1">Homebase</label>
                            <select name="year" class="form-select select-year" onchange="this.form.submit()">
                                <option value="">Prodi</option>
                                @php $currentYear = date('Y'); @endphp
                                @for($y = $currentYear; $y >= 2018; $y--)
                                    <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                                @endfor
                            </select>
                        </div>--}}
                       {{-- <div class="col-md-4 d-grid">
                            <button type="submit" class="btn btn-success btn-sm rounded-pill py-1 shadow-sm">
                                <i class="fas fa-filter me-2 text-white"></i> Filter
                            </button>
                        </div>--}}
                        @if(request('q'))
                            <div class="col-12 mt-2">
                                <a href="{{ route('lecturers.index') }}" class="text-danger small fw-bold text-decoration-none">
                                    <i class="fas fa-times-circle me-1"></i> Reset Filter
                                </a>
                            </div>
                        @endif
                    </form>
                </div>

                {{--data dosen--}}
                <div class="table-responsive shadow-lg rounded-4 overflow-hidden border-0">
                    <table class="table table-hover align-middle mb-0 custom-datatable">
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
                                <td class="px-4 py-3 text-center">
                                    <p>{{ $loop->iteration }}</p>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $item->photo_url }}" class="card-img-top" alt="{{ $item->name }}" style="height: 60px; width: 60px; object-fit: cover; border-radius: 50%; margin-right: 4px">
                                        <div class="text-dark fw-bold" style="font-size: 0.95rem; line-height: 1.4;">
                                            {{ $item->name }}
                                            <div style="color: gray; font-size: 0.75rem; font-weight: normal;">
                                                {{ $item->nip }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <span class="text-secondary small d-block"><i class="fas fa-user-circle me-2 opacity-50"></i>{{ $item->academic_title ?? 'Tutor/Dosen' }}</span>
                                </td>
                                <td class="py-3 text-center">
                            <span class="badge bg-soft-success px-3 py-2 rounded-pill text-success fw-bold" style="font-size: 0.8rem;">
                                {{ $item->position ?? '-' }}
                            </span>
                                </td>
                                <td class="px-4 py-3 text-end">
                                    <a href="{{ route('lecturers.show', $item->id) }}" class="btn btn-outline-primary btn-sm w-100 rounded-pill">{{ __('Lihat Profil') }}</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
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

                <div class="mt-5 d-flex justify-content-center">
                    {{ $dosen->links() }}
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
@endsection

@push('styles')
<style>
    .rotate-n-15 { transform: rotate(-15deg); }
    .transition-hover { transition: all 0.3s ease; }
    .transition-hover:hover { transform: translateY(-5px); box-shadow: 0 1rem 2rem rgba(0,0,0,0.1) !important; }
    .bg-gradient-dark {
        background: linear-gradient(0deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 100%);
    }
    .nav-pills .nav-link.active {
        background-color: var(--bs-primary);
        color: white;
    }
    .nav-pills .nav-link {
        color: var(--bs-secondary);
    }
</style>
@endpush
