<?php

namespace App\Models\Api;

class Alergen extends \App\Models\Alergen
{
    public function getRouteKeyName()
    {
        return 'id';
    }
}
