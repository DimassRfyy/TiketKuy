<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum BookingPaymentMethod: string implements HasLabel
{
    case TRANSFER = 'transfer';
    case CREDIT_CARD = 'credit_card';

    public function getLabel(): ?string
    {
        return str(str($this->value)->replace('_', ' '))->title();
    }

    public function getColor(): string
    {
        return match ($this) {
            self::TRANSFER => 'orange',
            self::CREDIT_CARD => 'indigo'
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::TRANSFER => 'heroicon-m-receipt-percent',
            self::CREDIT_CARD => 'heroicon-m-credit-card'
        };
    }
}
