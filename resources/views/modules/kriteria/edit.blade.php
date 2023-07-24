@extends('layouts.app')

@section('content')
@csrf
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="app-card app-card-orders-table shadow-sm mb-10">
                <div class="app-card-body">
                    <div class="app-content pt-3 p-md-3 p-lg-4">
                        <div class="container-xl">
                            <h2 class="auth-heading text-center mb-4">Masukkan Kriteria Anda</h2>
                            <div class="col-12 col-lg-9">
                                <!-- Edit Form -->
                                <form method="POST" action="{{ route('kriteria.update', $kriterias->id) }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="criteria">Kriteria:</label>
                                        <input type="text" class="form-control" id="criteria" name="criteria" value="{{ $kriterias->criteria }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="value">Nilai:</label>
                                        <input type="number" class="form-control" id="value" name="value" value="{{ $kriterias->value }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="type">Tipe:</label>
                                        <select class="form-control" id="type" name="type">
                                            <option value="kekurangan" {{ $kriterias->type == 'kekurangan' ? 'selected' : '' }}>Kekurangan</option>
                                            <option value="kelebihan" {{ $kriterias->type == 'kelebihan' ? 'selected' : '' }}>Kelebihan</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="normalization">Normalisasi:</label>
                                        <input type="number" class="form-control" id="normalization" name="normalization" value="{{ $currentNormalization }}" hidden>
                                    </div>

                                    <button type="submit" id="update-btn" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
