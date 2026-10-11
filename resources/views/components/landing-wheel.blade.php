@props(['id', 'finish' => 'silver', 'spokes' => 12])

<svg {{ $attributes->merge(['class' => 'landing-wheel']) }} viewBox="0 0 400 400" fill="none" aria-hidden="true" focusable="false">
    <defs>
        <linearGradient id="{{ $id }}-metal" x1="90" y1="40" x2="315" y2="365" gradientUnits="userSpaceOnUse">
            <stop stop-color="#fbfcfc"/><stop offset=".2" stop-color="#84878c"/><stop offset=".36" stop-color="#fafafa"/><stop offset=".55" stop-color="#b4b7ba"/><stop offset=".7" stop-color="#56595d"/><stop offset=".86" stop-color="#f6f6f6"/><stop offset="1" stop-color="#a7aaad"/>
        </linearGradient>
        <linearGradient id="{{ $id }}-face" x1="130" y1="65" x2="290" y2="350" gradientUnits="userSpaceOnUse">
            <stop stop-color="{{ $finish === 'gold' ? '#e8ce83' : '#fafcfd' }}"/>
            <stop offset=".45" stop-color="{{ $finish === 'gold' ? '#ac7b34' : '#9da3a8' }}"/>
            <stop offset=".7" stop-color="{{ $finish === 'gold' ? '#f6df95' : '#e5e8eb' }}"/>
            <stop offset="1" stop-color="{{ $finish === 'gold' ? '#87622e' : '#737b83' }}"/>
        </linearGradient>
        <radialGradient id="{{ $id }}-tire" cx=".34" cy=".2" r=".82">
            <stop stop-color="#505054"/><stop offset=".45" stop-color="#242427"/><stop offset=".8" stop-color="#101113"/><stop offset="1" stop-color="#323336"/>
        </radialGradient>
        <radialGradient id="{{ $id }}-barrel">
            <stop stop-color="#414449"/><stop offset=".68" stop-color="#141619"/><stop offset="1" stop-color="#555960"/>
        </radialGradient>
    </defs>
    <circle cx="200" cy="200" r="191" fill="url(#{{ $id }}-tire)" stroke="#202124" stroke-width="2"/>
    <circle cx="200" cy="200" r="183" stroke="#737378" stroke-opacity=".3" stroke-width="2"/>
    <circle cx="200" cy="200" r="174" stroke="#08090a" stroke-width="2"/>
    @for ($i = 0; $i < 64; $i++)
        <path d="M194 12 L201 23" stroke="#7b7c7f" stroke-opacity=".24" stroke-width="2" transform="rotate({{ $i * 5.625 }} 200 200)"/>
    @endfor
    <circle cx="200" cy="200" r="155" fill="url(#{{ $id }}-metal)" stroke="#131518" stroke-width="3"/>
    <circle cx="200" cy="200" r="143" stroke="#fff" stroke-opacity=".8" stroke-width="2"/>
    <circle cx="200" cy="200" r="136" fill="url(#{{ $id }}-barrel)" stroke="#62666a" stroke-width="3"/>
    <circle cx="200" cy="200" r="114" stroke="#929699" stroke-opacity=".4" stroke-width="8"/>
    <circle cx="200" cy="200" r="98" fill="#48494c" fill-opacity=".3" stroke="#16171a" stroke-width="2"/>
    @for ($i = 0; $i < $spokes; $i++)
        <path d="M191 178 L176 142 L162 72 L171 70 L195 140 L201 163 L209 140 L230 73 L239 76 L223 145 L209 180 Z" fill="url(#{{ $id }}-face)" stroke="{{ $finish === 'gold' ? '#6f5329' : '#737a80' }}" stroke-width="1" transform="rotate({{ $i * (360 / $spokes) }} 200 200)"/>
    @endfor
    @for ($i = 0; $i < 24; $i++)
        <circle cx="200" cy="58" r="2.7" fill="#44474b" stroke="#f4f4f4" stroke-width=".8" transform="rotate({{ $i * 15 }} 200 200)"/>
    @endfor
    <circle cx="200" cy="200" r="35" fill="url(#{{ $id }}-face)" stroke="#d3d4d5" stroke-width="1"/>
    @for ($i = 0; $i < 5; $i++)
        <circle cx="200" cy="175" r="4.5" fill="#17191c" stroke="#d2d4d6" stroke-width="1.5" transform="rotate({{ $i * 72 }} 200 200)"/>
    @endfor
    <circle cx="200" cy="200" r="14" fill="#25252a" stroke="#dfdfe2" stroke-width="2"/>
    <path d="M192 197 L198 203 M198 197 L192 203 M202 197 L208 203 M208 197 L202 203" stroke="#e72292" stroke-width="2"/>
</svg>
