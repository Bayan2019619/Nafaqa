<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\StatusEnum;
use App\Enums\GenderEnum;


class ProfileRole extends Model
{
      protected $fillable = [
        'user_id',
        'nationality_id',
        'first_name',
        'mid_name',
        'last_name',
        'date_of_birth',
        'national_no',
        'IBAN',
        'document_type',
        'document_no',
        'document_file_url',
        'status',
    ];

    protected $casts = [
        'status' => StatusEnum::class,
        'gender' => GenderEnum::class,
    ];

     public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function nationality()
    {
        return $this->belongsTo(Country::class, 'nationality_id');
    }
}
