<?php

namespace App\Repositories\Orders\Enums;

enum OrderStatus: int
{
    case Unpaid = 1;
    case Paid = 2;
    public function name()
    {
        return self::getName($this);
    }

    public static function getName(self $value)
    {
        return match ($value) {
            OrderStatus::Unpaid => 'Chưa thanh toán',
            OrderStatus::Paid => 'Đã thanh toán',
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
    public static function statusLog($status)
    {
        foreach (self::cases() as $payer) {
            if($payer->value == $status)
            {
                return self::getName($payer);
            }
        }
    }
}
