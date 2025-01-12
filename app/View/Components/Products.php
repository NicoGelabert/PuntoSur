<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Products extends Component
{
    public $products;
    /**
     * Create a new component instance.
     * @param  mixed  $services
     * @return void
     */
    public function __construct($products)
    {
        $this->products = $products;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.products');
    }
}
