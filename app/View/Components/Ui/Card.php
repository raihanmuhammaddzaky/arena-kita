<?php

namespace App\View\Components\Ui;

use Illuminate\View\Component;

class Card extends Component
{
    public string $padding;
    public string $shadow;
    public string $rounded;
    public string $border;
    public string $bg;

    public function __construct(
        string $padding = 'p-6',
        string $shadow = 'shadow-sm',
        string $rounded = 'rounded-2xl',
        string $border = 'border border-outline-variant/30',
        string $bg = 'bg-surface-container-lowest'
    ) {
        $this->padding = $padding;
        $this->shadow = $shadow;
        $this->rounded = $rounded;
        $this->border = $border;
        $this->bg = $bg;
    }

    public function classes(): string
    {
        return "{$this->bg} {$this->rounded} {$this->border} {$this->shadow} overflow-hidden {$this->padding}";
    }

    public function render()
    {
        return view('components.ui.card');
    }
}
