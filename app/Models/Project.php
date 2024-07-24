<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'start_date',
        'end_date',
        'images',
        'slug',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
