<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SamplePaper extends Model
{
    use HasFactory;
    protected $fillable = [
        'class_id',
        'subject_id',
        'youtube_link',
        'description',
    ];
    
    public function sampleDetails()
    {
        return $this->hasMany(SampleDetail::class, 'sample_paper_id', 'id');
    }
       // Define the relationship with SampleDetail
    public function details()
    {
        return $this->hasMany(SampleDetail::class, 'sample_id');
    }


    public function category()
    {
        return $this->belongsTo(Category::class, 'class_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}