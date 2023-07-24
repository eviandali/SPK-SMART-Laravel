<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembobotan extends Model
{
    protected $fillable = [
        'user_id',
        'alternatif_id',
        'kriteria_id',
        'criteria',
        'type',
        'bobot_kriteria',
        'value_util',
        'perkalian_bobot',
        'total',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class);
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}
