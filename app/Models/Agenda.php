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

    // public function scopeToday($query)
    // {
    //     return $query->whereDate('start_date', now()->toDateString());
    // }

    // public function scopeUpcoming($query)
    // {
    //     return $query->whereDate('start_date', '>', now()->toDateString());
    // }

    public function scopeToday($query)
    {
        $today = now()->startOfDay();

        return $query->where(function ($query) use ($today) {
            $query->whereDate('start_date', $today)
                ->orWhere(function ($query) use ($today) {
                    $query->whereDate('start_date', '<', $today)
                        ->whereDate('end_date', '>=', $today);
                });
        });
    }

    public function scopeUpcoming($query)
    {
        $tomorrow = now()->addDay()->startOfDay();
        return $query->where(function ($query) use ($tomorrow) {
            $query->whereDate('start_date', '>=', $tomorrow);
        });
    }

    public function getIsMultiDayAttribute()
    {
        if (!$this->end_date) {
            return false;
        }
        return $this->start_date->startOfDay()->diffInDays($this->end_date->startOfDay()) > 0;
    }

    public function getDateRangeAttribute()
    {
        if ($this->end_date || $this->start_date->isSameDay($this->end_date)) {
            return $this->start_date->translatedFormat('d M Y');
            }

            return $this->start_date->translatedFormat('d M Y') . ' - ' . 
            $this->end_date->translatedFormat('d M Y');
}
