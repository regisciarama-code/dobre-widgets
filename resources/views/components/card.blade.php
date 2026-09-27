@props([
    'title' => null,
    'subtitle' => null,
    'badge' => null,
    'badgeType' => 'blue',
])

<div {{ $attributes->merge(['class' => 'dobre-glass-card']) }}>
    @if($title || $badge)
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1.25rem;">
            <div>
                @if($title)
                    <h3 style="font-size: 1.15rem; font-weight: 700; color: var(--dobre-text); margin: 0;">{{ $title }}</h3>
                @endif
                @if($subtitle)
                    <div style="font-size: 0.825rem; color: var(--dobre-text-muted); margin-top: 2px;">{{ $subtitle }}</div>
                @endif
            </div>
            @if($badge)
                <span class="dobre-badge dobre-badge-{{ $badgeType }}">{{ $badge }}</span>
            @endif
        </div>
    @endif

    <div class="dobre-card-content">
        {{ $slot }}
    </div>
</div>
