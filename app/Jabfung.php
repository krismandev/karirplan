<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabfung extends Model
{
    protected $table = 'jabfung';
    protected $fillable = ['id_jabfung','nama_jabfung','angka_kredit'];
    protected $primaryKey = 'id_jabfung';

    public function jabfung_sementara()
    {
        return $this->hasMany(JabfungSementara::class,"id_jabfung","id_jabfung");
    }
}
