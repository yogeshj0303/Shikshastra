<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SampleDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'sample_id',
        'sample_paper_name',
        'image_path',
    ];
     public function samplePaper()
    {
        return $this->belongsTo(SamplePaper::class, 'sample_paper_id', 'id');
    }
}
