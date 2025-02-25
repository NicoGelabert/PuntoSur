<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Client extends Model
{
    use HasFactory;
    use HasSlug;
    use SoftDeletes;

    protected $fillable = [
        'full_name',
        'slug',
        'age',
        'phone_number',
        'emergency_phone_number',
        'town',
        'occupancy',
        'email',
        'treatment',
        'sore',
        'medication',
        'allergies',
        'medicalBackground',
        'sports',
        'currentDiet',
        'sleepPatterns',
        'waterIntake',
        'pregnancy',
        'menopause',
        'signed',
        'created_by',
        'updated_by'
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('full_name')
            ->saveSlugsTo('slug');
    }

}
