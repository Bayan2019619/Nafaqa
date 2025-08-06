<?php

namespace App\Models;

use App\GenderEnum;
use App\StatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class Child extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'case_id',
        'full_name',
        'nationality_no',
        'date_of_birth',
        'gender',
        'status',
    ];

      protected $casts = [
        'status' => StatusEnum::class,
        'gender' => GenderEnum::class,
    ];

    public function divorceCase()
    {
        return $this->belongsTo(DivorceCase::class, 'case_id');
    }
}
