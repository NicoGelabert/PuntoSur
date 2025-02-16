<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function view(About $about)
    {
        $about = About::first();
        return view('about.view', [
            'about' => $about,
        ]);
    }
}
