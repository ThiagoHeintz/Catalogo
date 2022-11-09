<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adm extends Model
{
    use HasFactory;
    public function catalogo() {
        return $this->belongsTo(Catalogo::class,'idAdm','id');
    }
}
