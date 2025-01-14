<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class About extends Component
{
    public $abouts;
    /**
     * Create a new component instance.
     * @param  mixed  $clients
     * @return void
     */
    public function __construct($abouts)
    {
        $this->abouts = $abouts;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.about');
    }
}
