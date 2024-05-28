<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Edukasi extends Model
{
    use HasFactory;

    protected $table = 'edukasis';
    protected $primaryKey = 'id_edukasi';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = false;

    public function topikEdukasi(): BelongsTo
    {
        return $this->belongsTo(TopikEdukasi::class, 'id_topik', 'id_topik');
    }
}
