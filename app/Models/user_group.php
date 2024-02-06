<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_group extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'group_id',
    ];
    public function groups(){
        return $this->belongsTo("App\Models\group","group_id");
    }
    public function users(){
        return $this->belongsTo("App\Models\user","user_id");
    }
}

