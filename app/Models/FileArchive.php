<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileArchive extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function secondary()
    {
        return $this->belongsTo(TypeSecondary::class, 'type_secondary_id', 'id');
    }

    public function tertiary()
    {
        return $this->belongsTo(TypeTertiary::class, 'type_tertiary_id', 'id');
    }

    public function sub()
    {
        return $this->belongsTo(TypeTertiarySub::class, 'type_tertiary_sub_id', 'id');
    }
}
