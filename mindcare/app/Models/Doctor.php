<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'specialization', 'bio', 'user_id','email','password'            
];

    public function run()
{

    Doctor::factory(10)->create();  
}

}
