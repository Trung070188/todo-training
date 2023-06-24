<?php

namespace App\Repositories\Orders\Enums;

enum OrderLogStatus: int
{
    case Create = 1;
    case Paid = 2;
    public function name()
    {
        return self::getName($this);
    }

    public static function getName(self $value)
    {
        return match ($value) {
            OrderLogStatus::Create => 'Tạo mới',
            OrderLogStatus::Paid => 'Đã thanh toán',
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
