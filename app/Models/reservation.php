<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'start_time',
        'end_time',
        'date',
        'group_id',
        'salle_id'
    ];
    public function groups(){
        return $this->belongsTo("App\Models\group","group_id");
    }
    public function salles(){
        return $this->belongsTo("App\Models\salle","salle_id");
    }
}
