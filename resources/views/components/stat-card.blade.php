@props([
    'title',
    'value',
    'icon' => 'fa-chart-pie',
    'color' => 'blue', // blue, success, warning, danger
    'trend' => null,
    'trendUp' => true,
])

<div {{ $attributes->merge(['class' => 'dobre-stat-card']) }}>
    <div class="dobre-stat-icon-wrapper dobre-stat-icon-{{ $color }}">
        <i class="fa-solid {{ $icon }}"></i>
    </div>
    <div class="dobre-stat-info">
        <div class="dobre-stat-title">{{ $title }}</div>
        <div class="dobre-stat-value">{{ $value }}</div>
        @if($trend)
            <div class="dobre-stat-trend {{ $trendUp ? 'dobre-trend-up' : 'dobre-trend-down' }}">
                <i class="fa-solid {{ $trendUp ? 'fa-arrow-trend-up' : 'fa-arrow-trend-down' }}"></i>
                <span>{{ $trend }}</span>
            </div>
        @endif
    </div>
</div>
