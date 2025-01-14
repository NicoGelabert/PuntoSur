<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends \App\Models\About
{
    public function getRouteKeyName()
    {
        return 'id';
    }

}
