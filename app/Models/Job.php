<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    
    protected $fillable=['job_type','job_title'];
    
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
    
    public function admindetails()
{
    return $this->belongsTo(Admin::class, 'admin_id'); // assuming you have a foreign key column named "admin_id" in the jobs table
}

public function savedJobs()
{
    return $this->hasMany(SavedJob::class, 'job_id');
}

public function applyJobs()
{
    return $this->hasMany(ApplyJob::class, 'job_id');
}



public function postedJobs()
{
    return $this->hasMany(Job::class); // Assuming you have defined the relationship correctly
}

  public function adminNew()
    {
        return $this->belongsTo(Admin::class);
    }


}
