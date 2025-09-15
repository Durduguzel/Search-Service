<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_source_id',
        'external_id',
        'title',
        'type',
        'views',
        'likes',
        'duration_seconds',
        'reading_time',
        'reactions',
        'comments',
        'published_at',
        'score',
        'raw'
    ];

    protected $casts = [
        'raw' => 'array',
        'published_at' => 'datetime',
    ];

    public function dataSource()
    {
        return $this->belongsTo(DataSource::class);
    }

    protected $with = ['tags'];
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function interactions()
    {
        return $this->hasMany(Interaction::class);
    }
}
