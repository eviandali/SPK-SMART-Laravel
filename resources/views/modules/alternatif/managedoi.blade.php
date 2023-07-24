@extends('layouts.app')

@section('content')
@csrf

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <div class="tab-content" id="orders-table-tab-content">
            <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">

                        <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">

                            <div class="inner">
                                <div class="app-card-body p-3 p-lg-4">

                                    <div class="row gx-5 gy-3">

                                        <div class="col-12 col-lg-9">

                                            <div>Apakah {{ $alternatifs->nama_doi }} Sesuai dengan Kriteria anda?... kalau iyaa selanjutnya anda tinggal memasukkan nilai dari kriteria yang telah anda buat sebelumnya.</div>
                                        </div><!--//col-->
                                        <div class="col-12 col-lg-3">
                                            <a class="btn app-btn-primary" href="https://themes.3rdwavemedia.com/bootstrap-templates/admin-dashboard/portal-free-bootstrap-admin-dashboard-template-for-developers/">Tutor Dek ?</a>
                                        </div><!--//col-->
                                    </div><!--//row-->
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div><!--//app-card-body-->

                            </div><!--//inner-->
                        </div>

				    </div>
                    <h1 class="app-page-title mb-0">Manage Ayang</h1>
                       <div class="app-card app-card-orders-table shadow-sm mb-10">
                    <div class="app-card-body">

                        <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                            <div class="app-card-header p-3 border-bottom-0">
                                <div class="row align-items-center gx-3">
                                    <div class="col-auto">
                                        <div class="app-icon-holder">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                            </svg>
                                        </div><!--//icon-holder-->
                                    </div><!--//col-->
                                    <div class="col-auto">
                                        <h4 class="app-card-title">Profile Doi</h4>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//app-card-header-->
                            <div class="app-card-body px-4 w-100">

                                <div class="item border-bottom py-3">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-auto">
                                            <div class="item-label mb-2"><strong>Photo Doi</strong></div>
                                            <div class="item-data align-center"><img height="400" src="{{ asset($alternatifs->foto_doi) }}"></div>
                                        </div><!--//col-->

                                    </div><!--//row-->

                                </div><!--//item-->
                                <div class="item border-bottom py-3">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-auto">
                                            <div class="item-label"><strong>Nama Doi</strong></div>
                                            <div class="item-data">{{ $alternatifs->nama_doi }}</div>
                                        </div><!--//col-->
                                    </div><!--//row-->
                                </div><!--//item-->
                            </div><!--//app-card-body-->
                    </div><!--//app-card-body-->
                </div>
            </div>

            </div>
        </div>

        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
            <div class="row g-3 mb-4 align-items-center justify-content-between">

                   <div class="app-card app-card-orders-table shadow-sm mb-10">
                <div class="app-card-body">

                    <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                        <div class="app-card-header p-3 border-bottom-0">
                            <div class="row align-items-center gx-3">
                                <div class="col-auto">
                                    <div class="app-icon-holder">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bar-chart-line" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1V2zm1 12h2V2h-2v12zm-3 0V7H7v7h2zm-5 0v-3H2v3h2z"></path>
                                          </svg>
                                    </div><!--//icon-holder-->
                                </div><!--//col-->
                                <div class="col-auto">
                                    <h4 class="app-card-title"> Penilaian</h4>
                                </div><!--//col-->
                            </div><!--//row-->
                        </div><!--//app-card-header-->
                        <div class="app-card-body px-4 w-100">

                            <form method="POST" action="{{ route('pembobotan.store') }}">
                                @csrf

                                <!-- Tambahkan input field untuk alternatif_id -->
                                <input type="hidden" name="alternatif_id" value="{{ $alternatifs->id }}">


                                    <!-- Looping untuk menampilkan kriteria -->
                                    @foreach ($kriterias as $kriteria)
                                        <div class="form-group">
                                            <label for="bobot_kriteria{{ $kriteria->id }}">{{ $kriteria->criteria }}</label>
                                            <input type="number" class="form-control" id="bobot_kriteria{{ $kriteria->id }}" name="bobot_kriteria[]" required>
                                            <input type="hidden" name="kriteria_id[]" value="{{ $kriteria->id }}">
                                        </div>
                                    @endforeach


                                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                            </form>

                    </div>
                        </div><!--//app-card-body-->
                </div><!--//app-card-body-->
            </div>


@endsection
