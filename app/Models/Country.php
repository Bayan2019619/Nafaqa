<?php

namespace App\Models;

use Altwaireb\Countries\Models\Country as Model;

class Country extends Model
{
    public function getNameAttribute(): string
{
    return app()->getLocale() === 'ar' ? $this->arabic_name : $this->english_name;
}

}
