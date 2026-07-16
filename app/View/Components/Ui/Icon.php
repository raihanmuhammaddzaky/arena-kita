<?php

namespace App\View\Components\Ui;

use Illuminate\View\Component;

class Icon extends Component
{
    public ?string $name;
    public string $type;
    public bool $filled;

    public function __construct(?string $name = null, string $type = 'outlined', bool $filled = false)
    {
        $this->name = $name;
        $this->type = $type;
        $this->filled = $filled;
    }

    public function classes(): string
    {
        return "material-symbols-{$this->type}";
    }

    public function style(): string
    {
        return $this->filled ? "font-variation-settings: 'FILL' 1;" : "";
    }

    public function render()
    {
        return view('components.ui.icon');
    }
}
