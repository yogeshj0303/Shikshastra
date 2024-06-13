<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedInternship extends Model
{
         

    use HasFactory;
    
    protected $fillable=['user_id','internship_id'];
    
   public function internship()
    {
        return $this->belongsTo(Internship::class, 'internship_id'); // Assuming 'internship_id' is the foreign key
    }
  
}