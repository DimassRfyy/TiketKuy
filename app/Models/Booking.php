<?php

namespace App\Models;

use App\Enums\BookingPaymentMethod;
use App\Enums\BookingStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'name',
        'phone',
        'email',
        'ticket_id',
        'total_participant',
        'booking_date',
        'price',
        'total',
        'status',
        'payment_method',
        'payment_proof',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'ticket_id' => 'integer',
        'booking_date' => 'date',
        'price' => 'integer',
        'total' => 'integer',
        'status' => BookingStatus::class,
        'payment_method' => BookingPaymentMethod::class
    ];

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    public function approve(): void
    {
        $this->status = BookingStatus::SUCCESS;
        $this->save();
    }

    public function reject(): void
    {
        $this->status = BookingStatus::CANCEL;
        $this->save();
    }
}
