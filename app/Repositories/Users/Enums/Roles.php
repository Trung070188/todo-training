<?php

namespace App\Repositories\Users\Enums;

enum Roles: int
{
    case ADMIN = 1;
    case CUSTOMER = 2;
    case EMPLOY = 3;
    public function name()
    {
        return self::getName($this);
    }

    public static function getName(self $value)
    {
        return match ($value) {
            Roles::ADMIN => 'Admin',
            Roles::CUSTOMER => 'Customer',
            Roles::EMPLOY => 'Employ'
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
