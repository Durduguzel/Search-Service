<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RawEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_source_id',
        'payload',
        'format',
        'http_status',
        'fetched_at',
    ];

    protected $casts = [
        'fetched_at' => 'datetime',
    ];

    public function dataSource()
    {
        return $this->belongsTo(DataSource::class);
    }
}
