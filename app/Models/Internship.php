<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    use HasFactory;
    
    protected $table = 'internships';
    protected $fillable = [
        'internship_title', 'internship_type', 'start_from', 'duration',
        'stipend', 'last_date', 'about_internship', 'skill', 'location',
        'who_can_apply', 'perks', 'openings', 'information'
    ];
    
      public function user()
    {
        return $this->belongsTo(User::class);
    }
    
   public function location()
    {
        return $this->belongsTo(Location::class, 'location', 'location');
    }
    
      public function admin()
    {
        return $this->hasOne(Admin::class, 'website', 'website');
    }
    
    public function savedInternships()
{
    return $this->hasMany(SavedInternship::class, 'internship_id');
}

public function applyInternships()
{
    return $this->hasMany(ApplyInternship::class, 'internship_id');
}
}