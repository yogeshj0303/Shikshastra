<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyInternship extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id','internship_id'];
}