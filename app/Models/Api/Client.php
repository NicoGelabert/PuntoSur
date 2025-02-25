<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends \App\Models\Client
{
    public function getRouteKeyName()
    {
        return 'id';
    }
}
