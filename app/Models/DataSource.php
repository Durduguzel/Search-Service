<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataSource extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'base_url',
        'format',
        'parser_class',
        'rate_limit_per_minute',
        'enabled',
    ];

    public function rawEntries()
    {
        return $this->hasMany(RawEntry::class);
    }

    public function contents()
    {
        return $this->hasMany(Content::class);
    }
}
