<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'user_id','criteria', 'value', 'type', 'normalization'
    ];

    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function pembobotan()
    {
        return $this->hashone(Pembobotan::class);
    }
}
