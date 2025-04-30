<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'location',
        // 'bidang_id',
        'is_published'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_published' => 'boolean'
    ];

    public function bidang()
    {
        return $this->belongsToMany(Bidang::class);
    }
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeToday($query)
    {
        return $query->whereDate('start_date', now()->toDateString());
    }

    public function scopeUpcoming($query)
    {
        return $query->whereDate('start_date', '>', now()->toDateString());
    }
}
