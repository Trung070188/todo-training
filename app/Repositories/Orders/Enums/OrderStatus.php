<?php

namespace App\Repositories\Orders\Enums;

enum OrderStatus: int
{
    case UNPAID = 1;
    case PAID = 2;
    public function name()
    {
        return self::getName($this);
    }

    public static function getName(self $value)
    {
        return match ($value) {
            OrderStatus::UNPAID => 'Chưa thanh toán',
            OrderStatus::PAID => 'Đã thanh toán',
        };
    }

    public static function all()
    {
        return array_column(self::cases(), 'name', 'value');
    }
    public static function displayAll()
    {
        $display = [];
        foreach (self::cases() as $payer) {
            $display[$payer->value] = self::getName($payer);
        }
        return $display;
    }
}
