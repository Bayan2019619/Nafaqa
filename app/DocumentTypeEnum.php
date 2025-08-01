<?php

namespace App;

enum DocumentTypeEnum: int
{
    case PASSPORT = 1;
    case IDENTIFICATION = 2;

    public function label(): string
    {
        return match($this) {
            self::PASSPORT => 'PASSPORT',
            self::IDENTIFICATION => 'IDENTIFICATION',
        };
    }

}
