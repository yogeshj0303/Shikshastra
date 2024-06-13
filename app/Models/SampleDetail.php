<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SampleDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'sample_id',
        'image_path',
    ];
}
