<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeTertiary extends Model
{
    use HasFactory;

    public function tertiary_subs()
    {
        return $this->hasMany(TypeTertiarySub::class);
    }

    public function secondary()
    {
        return $this->belongsTo(TypeSecondary::class);
    }
}
