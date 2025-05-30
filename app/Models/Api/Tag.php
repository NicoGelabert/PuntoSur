<?php

namespace App\Models\Api;

class Tag extends \App\Models\Tag
{
    public function getRouteKeyName()
    {
        return 'id';
    }
}
