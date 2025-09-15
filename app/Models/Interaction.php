<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Interaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'content_id',
        'type',
        'count',
    ];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}
