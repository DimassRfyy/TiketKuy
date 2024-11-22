<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Ticket extends Model
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
        'thumbnail',
        'video_url',
        'about',
        'address',
        'cs_name',
        'cs_phone',
        'cs_photo',
        'price',
        'category_id',
        'city_id',
        'opened_at',
        'closed_at',
        'is_popular',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'price' => 'integer',
        'category_id' => 'integer',
        'city_id' => 'integer',
        'is_popular' => 'boolean',
        'opened_at' => 'datetime',
        'closed_at' => 'datetime'
    ];

    public function ticketPhotos(): HasMany
    {
        return $this->hasMany(TicketPhoto::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    protected static function boot()
    {
        parent::boot();

        // Hapus gambar saat data ticket dihapus
        static::deleting(function ($ticket) {
            if ($ticket->thumbnail && Storage::disk('public')->exists($ticket->thumbnail)) {
                Storage::disk('public')->delete($ticket->thumbnail);
            }
            if ($ticket->cs_photo && Storage::disk('public')->exists($ticket->cs_photo)) {
                Storage::disk('public')->delete($ticket->cs_photo);
            }

            // Hapus gambar dari relasi ticketPhotos
            foreach ($ticket->ticketPhotos as $ticketPhoto) {
                if ($ticketPhoto->photo && Storage::disk('public')->exists($ticketPhoto->photo)) {
                    Storage::disk('public')->delete($ticketPhoto->photo);
                }
            }
        });

        // Hapus gambar lama sebelum diperbarui
        static::updating(function ($ticket) {
            if ($ticket->isDirty('thumbnail') && $ticket->getOriginal('thumbnail')) {
                Storage::disk('public')->delete($ticket->getOriginal('thumbnail'));
            }
            if ($ticket->isDirty('cs_photo') && $ticket->getOriginal('cs_photo')) {
                Storage::disk('public')->delete($ticket->getOriginal('cs_photo'));
            }
        });
    }
}
