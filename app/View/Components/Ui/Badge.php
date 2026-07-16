<?php

namespace App\View\Components\Ui;

use Illuminate\View\Component;

class Badge extends Component
{
    public string $variant;
    public ?string $icon;

    public function __construct(string $variant = 'default', ?string $icon = null)
    {
        $this->variant = $variant;
        $this->icon = $icon;
    }

    public function classes(): string
    {
        $baseClasses = "font-label-md text-[12px] px-3 py-1 rounded-full flex items-center gap-1 w-fit whitespace-nowrap";
        
        $variantClasses = match($this->variant) {
            'warning' => 'bg-[#f59e0b]/10 text-[#b45309]',
            'success' => 'bg-[#10b981]/10 text-[#047857]',
            'danger' => 'bg-error/10 text-error',
            'primary' => 'bg-primary/10 text-primary',
            'secondary' => 'bg-secondary-container text-on-secondary-container',
            default => 'bg-surface-container-low border border-outline-variant/30 text-on-surface',
        };
        
        return "{$baseClasses} {$variantClasses}";
    }

    public function render()
    {
        return view('components.ui.badge');
    }
}
