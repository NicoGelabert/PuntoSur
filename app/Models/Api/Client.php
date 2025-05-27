<?php

namespace App\Models\Api;

class Client extends \App\Models\Client
{
    public function getRouteKeyName()
    {
        return 'id';
    }
}
