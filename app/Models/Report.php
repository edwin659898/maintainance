<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function headers()
    {
        return $this->hasMany(Header::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function UserMail()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()->Where('machine_name', 'like', '%'.$search.'%')
                ->orWhere('number_plate', 'like', '%'.$search.'%')
                ->orWhere('owner', 'like', '%'.$search.'%')
                ->orWhere('admincomment', 'like', '%'.$search.'%')
                ->orWhere('approved_date', 'like', '%'.$search.'%')
                ->orWhere('type', 'like', '%'.$search.'%');
    }
}
