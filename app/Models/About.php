<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class About extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'image_mime', 'image_size', 'headline', 'short_description', 'large_description', 'signature', 'mission_and_vision', 'created_by', 'updated_by'];
}
