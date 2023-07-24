@extends('layouts.app')

@section('content')
@csrf

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <div class="tab-content" id="orders-table-tab-content">
            <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Kriteria</h1>

				    </div>
                       <div class="app-card app-card-orders-table shadow-sm mb-10">
                    <div class="app-card-body">

                        <div class="table-responsive">
                            <a type="button" class="btn btn-app-primary w-10 theme-btn mx-auto" href="{{ route('kriteria.create') }}">Tambah Data +</a>
                                </div>
                            <table class="table app-table-hover mb-0 text-left">
                                <thead>
                                    <tr>
                                        <th class="cell">Kriteria</th>
                                        <th class="cell">Nilai</th>
                                        <th class="cell">Tipe</th>
                                        <th class="cell">Normalisasi</th>
                                        <th class="cell">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kriterias as $kriteria)
                                    <tr>
                                        <td class="cell"><span class="truncate">{{ $kriteria->criteria }}</span></td>
                                        <td class="cell"><span class="truncate">{{ $kriteria->value }} </span> </td>
                                        <td class="cell"><span class="truncate">{{ $kriteria->type }} </span> </td>
                                        <td class="cell"><span class="truncate">{{ $kriteria->normalization }} </span> </td>
                                        <td><a class="btn-sm app-btn-secondary" href="{{ route('kriteria.edit', $kriteria->id) }}">Edit</a> <span> </span><form action="{{ route('kriteria.destroy', $kriteria->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                        </form></td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div><!--//table-responsive-->

                    </div><!--//app-card-body-->

                </div>
            </div>
        </div>
    </div>

@endsection
