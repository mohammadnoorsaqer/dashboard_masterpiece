<?php
// Review model (App\Models\Review.php)

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $primaryKey = 'review_id';  // If your primary key is not 'id'
    protected $fillable = ['appointment_id', 'user_id', 'status', 'comments'];
    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
