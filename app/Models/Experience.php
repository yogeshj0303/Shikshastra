<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;
    
        protected $fillable = ['user_id', 'designation', 'organization','location', 'start_date', 'end_date', 'description', 'is_work_home'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}