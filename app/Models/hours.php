<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hours extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function checklist()
    {
        return $this->hasMany(check::class);
    }

    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()->Where('machine_name', 'like', '%'.$search.'%')
                ->orWhere('hours', 'like', '%'.$search.'%');
    }
}
