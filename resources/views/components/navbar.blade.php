@props([
    'title' => config('app.name', 'Sistema Dobre'),
    'logo' => null,
    'showSearch' => true,
    'showThemeToggle' => true,
])

<nav {{ $attributes->merge(['class' => 'dobre-glass-panel']) }} style="padding: 1rem 1.5rem; margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center; border-radius: var(--dobre-radius-lg);">
    <div style="display: flex; align-items: center; gap: 1rem;">
        <a href="/" style="display: flex; align-items: center; gap: 10px; text-decoration: none; color: inherit;">
            @if($logo)
                <img src="{{ $logo }}" alt="{{ $title }}" style="height: 36px; object-fit: contain;">
            @else
                <div class="dobre-footer-icon-d">D</div>
            @endif
            <span style="font-family: var(--dobre-font-heading); font-weight: 700; font-size: 1.25rem;">{{ $title }}</span>
        </a>
    </div>

    <div style="display: flex; align-items: center; gap: 1rem;">
        {{ $slot }}

        @if($showSearch)
            <button class="dobre-btn dobre-btn-secondary dobre-btn-sm" data-dobre-search-trigger="true" title="Busca Rápida (Estilo Dobre)">
                <i class="fa-solid fa-magnifying-glass"></i>
                <span class="d-none d-md-inline">Buscar...</span>
            </button>
        @endif

        @if($showThemeToggle)
            <button class="dobre-btn dobre-btn-glass dobre-btn-icon" data-dobre-theme-toggle title="Alternar Modo Escuro / Claro">
                <i class="fa-solid fa-moon"></i>
            </button>
        @endif
    </div>
</nav>
