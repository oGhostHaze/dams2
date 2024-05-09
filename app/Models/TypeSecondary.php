<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeSecondary extends Model
{
    use HasFactory;

    public function tertiaries()
    {
        return $this->hasMany(TypeTertiary::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
