<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salle extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image_path',
        'number_u',
        'desc'
    ];
    public function reservations(){
        $res="\s";
        $s=substr($res,0,1);
        return $this->hasMany("App\Models".$s."reservation","salle_id");
    }
}
