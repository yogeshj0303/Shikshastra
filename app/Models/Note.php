<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $fillable = [
        'class_id',
        'subject_id',
        'chapter_id',
        'youtube_link',
        'description',
    ];
    public function details()
{
    return $this->hasMany(NoteDetail::class);
}
}
