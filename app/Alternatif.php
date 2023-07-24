<?php

namespace App;
use App\pembobotan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Alternatif extends Model
{

    public $timestamps = false;
    protected $fillable = [
        'user_id', 'nama_doi', 'foto_doi',
    ];

    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function pembobotan()
    {
        return $this->hasMany(Pembobotan::class, 'alternatif_id');
    }

}
