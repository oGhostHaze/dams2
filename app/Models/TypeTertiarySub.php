<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeTertiarySub extends Model
{
    use HasFactory;

    public function tertiary()
    {
        return $this->belongsTo(TypeTertiary::class);
    }
}
