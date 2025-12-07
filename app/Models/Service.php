<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'game',
        'category',
        'name',
        'description',
        'price',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Scope for active services only
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for specific game
     */
    public function scopeForGame($query, $game)
    {
        return $query->where('game', $game);
    }

    /**
     * Scope for specific category
     */
    public function scopeInCategory($query, $category)
    {
        return $query->where('category', $category);
    }
}