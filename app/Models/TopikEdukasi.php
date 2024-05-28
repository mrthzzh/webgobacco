<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class TopikEdukasi extends Model
{
    use HasFactory;
    
    protected $table = 'topik_edukasis';
    protected $primaryKey = 'id_topik';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = false;
    public function edukasi(): HasMany
    {
        return $this->hasMany(Edukasi::class, 'id_topik', 'id_topik');
    }
}
