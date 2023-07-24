@extends('layouts.app')

@section('content')
<script>
    function addField() {
        var formTable = document.getElementById("form-table");

        var row = document.createElement("tr");

        var criteriaCell = document.createElement("td");
        var criteriaInput = document.createElement("input");
        criteriaInput.type = "text";
        criteriaInput.name = "criteria[]";
        criteriaInput.placeholder = "Kriteria";
        criteriaCell.appendChild(criteriaInput);
        row.appendChild(criteriaCell);

        var valueCell = document.createElement("td");
        var valueInput = document.createElement("input");
        valueInput.type = "number";
        valueInput.name = "value[]";
        valueInput.placeholder = "Nilai";
        valueInput.oninput = function() {
            calculateNormalization();
        };
        valueCell.appendChild(valueInput);
        row.appendChild(valueCell);

        var typeCell = document.createElement("td");
        var typeSelect = document.createElement("select");
        typeSelect.name = "type[]";

        var optionDefault = document.createElement("option");
        optionDefault.value = "";
        optionDefault.textContent = "Pilih Tipe";
        typeSelect.appendChild(optionDefault);

        var optionKekurangan = document.createElement("option");
        optionKekurangan.value = "kekurangan";
        optionKekurangan.textContent = "Kekurangan";
        typeSelect.appendChild(optionKekurangan);

        var optionKelebihan = document.createElement("option");
        optionKelebihan.value = "kelebihan";
        optionKelebihan.textContent = "Kelebihan";
        typeSelect.appendChild(optionKelebihan);

        typeCell.appendChild(typeSelect);
        row.appendChild(typeCell);

        var normalizationCell = document.createElement("td");
        var normalizationInput = document.createElement("input");
        normalizationInput.type = "number";
        normalizationInput.name = "normalization[]";
        normalizationInput.placeholder = "Normalisasi";
        normalizationInput.readOnly = true;
        normalizationCell.appendChild(normalizationInput);
        row.appendChild(normalizationCell);

        var deleteCell = document.createElement("td");
        var deleteButton = document.createElement("button");
        deleteButton.type = "button";
        deleteButton.textContent = "Hapus Field";
        deleteButton.onclick = function() {
            deleteField(row);
        };
        deleteCell.appendChild(deleteButton);
        row.appendChild(deleteCell);

        formTable.appendChild(row);
    }

    function deleteField(row) {
        var formTable = document.getElementById("form-table");
        formTable.removeChild(row);

        calculateNormalization();
    }

    function calculateNormalization() {
        var valueInputs = document.getElementsByName("value[]");
        var total = 0;

        for (var i = 0; i < valueInputs.length; i++) {
            total += parseFloat(valueInputs[i].value) || 0;
        }

        var normalizationInputs = document.getElementsByName("normalization[]");

        for (var j = 0; j < normalizationInputs.length; j++) {
            var value = parseFloat(valueInputs[j].value) || 0;
            var normalization = value / total;
            normalizationInputs[j].value = normalization.toFixed(2);
        }
    }
</script>
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
                                        <h2 class="auth-heading text-center mb-4">Masukkan Kriteria Anda</h2>

                                        <div class="col-12 col-lg-9">
                                            <form method="post" action="{{route('kriteria.store') }}">
                                                @csrf
                                                <table id="form-table">
                                                    <tr>
                                                        <th>Kriteria</th>
                                                        <th>Nilai</th>
                                                        <th>Tipe</th>
                                                        <th>Normalisasi</th>
                                                        <th></th>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="text" class="form-control signup-password" name="criteria[]" placeholder="Kriteria">
                                                        </td>
                                                        <td>
                                                            <input type="number" name="value[]" class="form-control signup-password" placeholder="Nilai" oninput="calculateNormalization()">
                                                        </td>
                                                        <td>
                                                            <select aria-labelledby="user-dropdown-toggle" class="form-control signup-password" name="type[]">
                                                                <option value="">Pilih Tipe</option>
                                                                <option value="kekurangan">Kekurangan</option>
                                                                <option value="kelebihan">Kelebihan</option>
                                                            </select>
                                                        </td>

                                                        <td>
                                                            <input type="number" class="form-control signup-password" name="normalization[]" placeholder="Normalisasi" readonly>
                                                        </td>
                                                        <td>
                                                            <div class="app-card-footer p4 mt-auto">
                                                            <button type="button" class="btn btn-app-secondary" disabled>Hapus Field</button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <br>
                                                <div class="app-card-footer p4 mt-auto">
                                                <a type="button" class="btn btn-app-secondary" onclick="addField()">Tambah Field +</a>
                                                </div>
                                                <br><br>
                                                <input type="submit" class="btn app-btn-primary w-10 theme-btn mx-auto" value="Submit">
                                            </form>
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
