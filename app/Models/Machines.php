<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machines extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
    return $this->belongsTo('App\Models\User', 'process_owner');
    } 
    
    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()->Where('machine_name', 'like', '%'.$search.'%')
                ->orWhere('number_plate', 'like', '%'.$search.'%')
                ->orWhere('site', 'like', '%'.$search.'%');
    }
}
