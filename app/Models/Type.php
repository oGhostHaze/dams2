<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function secondaries()
    {
        return $this->hasMany(TypeSecondary::class);
    }

    public function archives()
    {
        return $this->hasMany(FileArchive::class);
    }
}