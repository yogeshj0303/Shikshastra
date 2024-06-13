<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    
    protected $fillable= ['first_name','last_name','role_id','username','email','logo','industry','website','phone','address','employee','description','latitude','longitude','password'];
    
      
public function internships()
{
    return $this->hasMany(Internship::class);
}

public function postedJobs()
{
    return $this->hasMany(Job::class, 'admin_id'); // 'admin_id' should be replaced with the actual foreign key column name
}
      public function jobs()
    {
        return $this->hasMany(Job::class);
    }
  
}
