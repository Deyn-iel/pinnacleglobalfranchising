@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-white'])

@php
/* Desktop alignment */
$alignmentClasses = match ($align) {
    'left' => 'left-0 origin-top-left',
    'top'  => 'origin-top',
    default => 'right-0 origin-top-right',
};

/* Desktop width */
$widthClass = match ($width) {
    '48' => 'w-48',
    default => $width,
};
@endphp

<div 
    class="relative" 
    x-data="{ open: false }"
    @click.outside="open = false"
>
    <!-- Trigger -->
    <div @click="open = ! open" class="cursor-pointer">
        {{ $trigger }}
    </div>

    <!-- Dropdown -->
    <div 
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        
        class="absolute z-50 mt-2 rounded-md shadow-lg 
               {{ $widthClass }} {{ $alignmentClasses }}
               dropdown-container-responsive"
        
        style="display: none;"
    >
        <div class="rounded-md border border-gray-200 shadow-sm {{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>
