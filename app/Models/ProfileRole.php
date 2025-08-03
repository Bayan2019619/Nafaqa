<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\StatusEnum;
use App\GenderEnum;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileRole extends Model
{
    use SoftDeletes;

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
        'gender'
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
