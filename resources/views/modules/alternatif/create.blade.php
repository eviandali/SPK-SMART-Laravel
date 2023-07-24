@extends('layouts.app')

@section('content')

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <div class="tab-content" id="orders-table-tab-content">
            <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
                        <div class="app-card app-card-orders-table shadow-sm mb-10">
                            <div class="app-card-body">
                                <div class="app-content pt-3 p-md-3 p-lg-4">
                                    <div class="container-xl">
                                        <h2 class="auth-heading text-center mb-4">Masukkan Doi Anda</h2>

                                        <div class="col-12 col-lg-9">
                                            @if(session()->has('success'))
                                            <div class="alert alert-success">
                                                {{ session()->get('success') }}
                                            </div>
                                        @endif
                                            <form class="form" method="POST"  action="{{ route('alternatif.store') }}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="email mb-3">
                                                    <label  for="nama-doi">Nama Doi</label>
                                                    <input id="nama-doi" name="nama_doi" type="text" value="{{ old('nama_doi') }}" class="form-control " placeholder="Full name" required="required">

                                                </div>
                                                <div>
                                                    <label  for="foto_doi">Foto Doi</label>
                                                    <input id="foto_doi" name="fotodoi" type="file" value="{{ old('foto_doi') }}" class="form-control" required="required">

                                                </div>


                                                <div class="text-center">
                                                    <button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Simpan</button>
                                                </div>
                                            </form><!--//auth-form-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                         </div>
                        </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
