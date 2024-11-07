<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = ['name_category', 'description'];


    public function ticket()
{
    return $this->hasMany(ticket::class);
}

}
