@props([
    'company' => config('dobre-widgets.branding.company_name', 'Dobre Tecnologia'),
    'url' => config('dobre-widgets.branding.url', 'https://dobretecnologia.com'),
    'version' => config('dobre-widgets.version', '2.5.0'),
    'badge' => config('dobre-widgets.branding.badge', 'Padrão Dobre IHC'),
])

<footer {{ $attributes->merge(['class' => 'dobre-footer']) }}>
    <div class="dobre-footer-content">
        <!-- Logotipo e Assinatura Dobre -->
        <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" class="dobre-footer-brand" title="Visitar Dobre Tecnologia">
            <div class="dobre-footer-icon-d">D</div>
            <div class="dobre-footer-brand-text">
                Desenvolvido por <span>{{ $company }}</span>
            </div>
        </a>

        <!-- Links e Status -->
        <div class="dobre-footer-links">
            <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" class="dobre-footer-link">Sobre a Empresa</a>
            <span class="dobre-footer-badge">
                <span class="dobre-status-dot active"></span>
                <span>{{ $badge }}</span> &bull; <span>v{{ $version }}</span>
            </span>
        </div>
    </div>
</footer>
