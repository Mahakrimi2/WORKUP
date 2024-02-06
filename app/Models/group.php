<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class group extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_g',
        'nb_u',
        'user_id',
        'type',
    ];
    public function reservations(){
        $res="\s";
        $s=substr($res,0,1);
        return $this->hasMany("App\Models".$s."reservation","group_id");
    }
    public function users(){
        return $this->hasMany("App\Models\user_group","group_id");
    }
    public function usermaker(){
        return $this->belongsTo("App\Models\User","user_id");
    }
}
