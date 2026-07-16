<?php

namespace App\View\Components\Ui;

use Illuminate\View\Component;

class Button extends Component
{
    public string $variant;
    public string $size;
    public ?string $icon;
    public string $iconPosition;
    public string $type;
    public ?string $href;

    public function __construct(
        string $variant = 'primary',
        string $size = 'md',
        ?string $icon = null,
        string $iconPosition = 'left',
        string $type = 'button',
        ?string $href = null
    ) {
        $this->variant = $variant;
        $this->size = $size;
        $this->icon = $icon;
        $this->iconPosition = $iconPosition;
        $this->type = $type;
        $this->href = $href;
    }

    public function classes(): string
    {
        $baseClasses = "inline-flex items-center justify-center gap-2 font-label-md transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2";
        
        $sizeClasses = match($this->size) {
            'sm' => 'px-4 py-2 text-sm rounded-lg',
            'lg' => 'px-8 py-4 text-lg rounded-xl',
            default => 'px-6 py-3 rounded-xl', // md
        };

        $variantClasses = match($this->variant) {
            'primary' => 'bg-primary text-on-primary hover:bg-primary/90 focus:ring-primary',
            'secondary' => 'bg-secondary-container text-on-secondary-container hover:bg-secondary-container/90 focus:ring-secondary',
            'outline' => 'bg-transparent border border-outline-variant/50 text-primary hover:bg-surface-container focus:ring-primary shadow-none',
            'danger' => 'bg-[#ef4444] text-white hover:bg-[#dc2626] focus:ring-[#ef4444]',
            'danger-outline' => 'bg-transparent border border-error text-error hover:bg-error/10 focus:ring-error shadow-none',
            'ghost' => 'bg-transparent text-primary hover:bg-surface-container shadow-none',
            default => 'bg-surface-container-low text-on-surface hover:bg-surface-container border border-outline-variant/50 focus:ring-surface-container',
        };
        
        return "{$baseClasses} {$sizeClasses} {$variantClasses}";
    }

    public function render()
    {
        return view('components.ui.button');
    }
}
