<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JabfungSementara extends Model
{
    protected $table = 'jabfung_sementara';
    protected $fillable = ['id_jabfung_sementara','id_pegawai','id_jabfung'];
    protected $primaryKey = 'id_jabfung_sementara';

    public function jabfung()
    {
        return $this->belongsTo(Jabfung::class,"id_jabfung","id_jabfung");
    }
}
