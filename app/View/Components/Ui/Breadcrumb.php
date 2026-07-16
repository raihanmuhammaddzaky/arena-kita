<?php

namespace App\View\Components\Ui;

use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public array $links;

    /**
     * Create a new component instance.
     *
     * @param array $links Array of arrays with 'label' and 'url' keys
     */
    public function __construct(array $links = [])
    {
        $this->links = $links;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.ui.breadcrumb');
    }
}
