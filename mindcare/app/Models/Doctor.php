<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',             
        'email',            
        'password',          
        'specialization',   
        'bio',             
    ];
    public function run()
{

    Doctor::factory(10)->create();  
}
}
