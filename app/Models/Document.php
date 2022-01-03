<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function reliefType()
    {
        return $this->belongsTo(ReliefType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
