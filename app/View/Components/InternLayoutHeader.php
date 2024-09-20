<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InternLayoutHeader extends Component
{
    public $judul;

    /**
     * Create a new component instance.
     *
     * @param string $judul
     */
    public function __construct($judul)
    {
        $this->judul = $judul;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.intern-layout-header');
    }
}