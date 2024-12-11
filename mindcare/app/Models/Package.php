<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category',
        'price',
        'duration',
        'status',
    ];
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}   
