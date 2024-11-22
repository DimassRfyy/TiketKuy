<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'light_icon',
        'dark_icon',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        // Hapus gambar saat data category dihapus
        static::deleting(function ($category) {
            if ($category->light_icon && Storage::disk('public')->exists($category->light_icon)) {
                Storage::disk('public')->delete($category->light_icon);
            }
            if ($category->dark_icon && Storage::disk('public')->exists($category->dark_icon)) {
                Storage::disk('public')->delete($category->dark_icon);
            }
        });

        // Hapus gambar lama sebelum diperbarui
        static::updating(function ($category) {
            if ($category->isDirty('light_icon') && $category->getOriginal('light_icon')) {
                Storage::disk('public')->delete($category->getOriginal('light_icon'));
            }
            if ($category->isDirty('dark_icon') && $category->getOriginal('dark_icon')) {
                Storage::disk('public')->delete($category->getOriginal('dark_icon'));
            }
        });
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
