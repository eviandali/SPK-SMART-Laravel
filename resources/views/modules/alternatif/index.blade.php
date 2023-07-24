@extends('layouts.app')

@section('content')

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">List Ayang Anda</h1>
        <div class="row gy-4">
            <div class="app-card-footer p-4 mt-auto">
                <a class="btn app-btn-secondary" href="{{ route('alternatif.create') }}">Tambah Ayang</a>
            </div>


        @foreach($alternatifs as $alternatif)

            <div class="col-12 col-lg-6">
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
                                    <div class="item-data align-center"><img height="400"  src="{{ asset($alternatif->foto_doi) }}"></div>
                                </div><!--//col-->

                            </div><!--//row-->

                        </div><!--//item-->
                        <div class="item border-bottom py-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <div class="item-label"><strong>Nama Doi</strong></div>
                                    <div class="item-data">{{ $alternatif->nama_doi }}</div>
                                </div><!--//col-->

                            </div><!--//row-->
                        </div><!--//item-->

                    </div><!--//app-card-body-->
                    <div class="app-card-body px-4 w-100">

                            @csrf
                        <!-- Tampilkan data pembobotan jika ada -->
                        @if ($alternatif->pembobotan->isNotEmpty())
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label mb-2"><strong>Penilaian Kriteria</strong></div>
                                        <div class="table-responsive">

                                         <table class="table app-table-hover mb-0 text-left">
                                            <thead>
                                                <tr>
                                                <th class="cell">Kriteria</th>
                                                <th class="cell">Bobot Kriteria</th>
                                                <th class="cell">Nilai Utility</th>
                                                <th class="cell">Nilai Utility X Normalisasi </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($alternatif->pembobotan as $pembobotan)
                                                <tr>
                                                    <td class="cell"><span class="truncate">  {{ $pembobotan->criteria }}</span></td>
                                                    <td class="cell"><span class="truncate"> {{ $pembobotan->bobot_kriteria }} </span></td>
                                                    <td class="cell"><span class="truncate"> {{ $pembobotan->value_util }}  </span></td>
                                                    <td class="cell"><span class="truncatr"> {{ $pembobotan->perkalian_bobot }} </span></td>
                                                </tr>



                                                @endforeach
                                            </tbody>
                                         </table>




                                        </div>
                                        <div class="item border-bottom py-3">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="col-auto">
                                                    <div class="item-label"><strong>Total Nilai</strong></div>
                                                    <div class="item-data"><strong>{{$pembobotan->total }}</strong></div>
                                                </div><!--//col-->
                                            </div><!--//row-->
                                        </div><!--//item-->
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->



                        <a class="btn app-btn-secondary" href="{{ route('pembobotan.edit', $alternatif->id )}}">Edit Pembobotan</a>

                        <form method="POST" action="{{ route('pembobotan.hitung') }}">
                            @csrf
                            <input type="hidden" name="alternatif_id" value="{{ $alternatif->id }}">

                            <button type="submit" class="btn app-btn-primary">Hitung</button>


                        </form>

                        @else

                            <!-- Tampilkan pesan jika tidak ada data pembobotan -->
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Penilaian Kriteria</strong></div>
                                        <div class="item-data">Silahkan masukkan penilaian berdasarkan kriteria</div>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->
                        @endif
                    </div><!--//app-card-body-->
                    <div class="app-card-footer p-4 mt-auto">
                        <a class="btn app-btn-secondary" href="{{ route('alternatif.managedoi', $alternatif->id )}}">Manage Pembobotan</a>

                    </div>

                </div>
            </div><!--//col-->
            @endforeach
        </div>
    </div>
</div>



@endsection
