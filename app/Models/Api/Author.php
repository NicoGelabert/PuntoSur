<?php

namespace App\Models\Api;

class Author extends \App\Models\Author
{
    public function getRouteKeyName()
    {
        return 'id';
    }
}
