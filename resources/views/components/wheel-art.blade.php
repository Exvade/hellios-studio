@props(['size' => 'card', 'tone' => 'silver'])
@php($dimensions = $size === 'hero' ? 'h-64 w-64 sm:h-80 sm:w-80' : 'h-40 w-40')
<div {{ $attributes->merge(['class' => "wheel-art {$dimensions} {$tone}"]) }} aria-hidden="true"><span class="wheel-rim"></span><span class="wheel-spokes"></span><span class="wheel-hub"></span></div>
