<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name',
        'role',
        'category',
        'message',
        'avatar',
        'is_approved',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    /**
     * Hanya testimoni yang sudah disetujui admin yang tampil di beranda.
     */
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }
}
