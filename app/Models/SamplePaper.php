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
        'sample_paper_name',
        'youtube_link',
        'description',
    ];
}
