<?php

namespace App\Models\api;

class Alergen extends \App\Models\Alergen
{
    public function getRouteKeyName()
    {
        return 'id';
    }
}
