<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class City extends Model
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
        'photo',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
    protected static function boot()
    {
        parent::boot();

        // Hapus gambar saat data city dihapus
        static::deleting(function ($city) {
            if ($city->photo && Storage::disk('public')->exists($city->photo)) {
                Storage::disk('public')->delete($city->photo);
            }
        });

        // Hapus gambar lama sebelum diperbarui
        static::updating(function ($city) {
            if ($city->isDirty('photo') && $city->getOriginal('photo')) {
                Storage::disk('public')->delete($city->getOriginal('photo'));
            }
        });
    }
}
