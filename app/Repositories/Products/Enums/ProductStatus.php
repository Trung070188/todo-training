<?php

namespace App\Repositories\Products\Enums;

enum ProductStatus: int
{
    case ACTIVE = 1;
    case NOT_ACTIVE = 2;
    public function name()
    {
        return self::getName($this);
    }

    public static function getName(self $value)
    {
        return match ($value) {
            ProductStatus::ACTIVE => 'Hiển thị',
            ProductStatus::NOT_ACTIVE => 'Không hiển thị',
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
