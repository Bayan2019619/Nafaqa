<?php

namespace App;

enum StatusEnum: int
{
    case Pending = 0;
    case Active = 1;
    case Inactive = 2;
    case Rejected = 3;


    public function label(): string
    {
        return match($this) {
            self::Pending => 'Pending',
            self::Active => 'Active',
            self::Inactive => 'Inactive',
            self::Rejected => 'Rejected',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::Pending => 'warning',
            self::Active => 'success',
            self::Inactive => 'secondary',
            self::Rejected => 'danger',
        };
    }

     public function realColor(): string
    {
        return match($this) {
            self::Pending => 'yellow',
            self::Active => 'green',
            self::Inactive => 'gray',
            self::Rejected => 'red',
        };
    }

    public function icon(): string
    {
        return match($this) {
            self::Pending => 'clock',
            self::Active => 'check',
            self::Inactive => 'pause',
            self::Rejected => 'x',
        };
    }
}
