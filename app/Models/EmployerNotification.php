<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployerNotification extends Model
{
    use HasFactory;
    
    
        protected $fillable=['user_id','type','date','message','notification_to','job_id'];
}