@props([
    'name' => config('dobre-widgets.ai.name', 'Inteligência Dobre'),
    'endpoint' => config('dobre-widgets.ai.endpoint', '/dobre-api/ai/ask'),
    'greeting' => config('dobre-widgets.ai.default_greeting', 'Olá! Sou o assistente de IA da Dobre Tecnologia.'),
])

<div class="dobre-ai-widget" data-dobre-ai="true" data-endpoint="{{ $endpoint }}">
    <button class="dobre-ai-toggle" aria-label="Abrir Assistente de IA">
        <img src="{{ asset('assets/brand/dobre-ai-icon.png') }}" style="width: 26px; height: 26px; filter: brightness(0) invert(1);" alt="Inteligência Dobre" />
    </button>
    <div class="dobre-ai-window">
        <div class="dobre-ai-header">
            <div class="dobre-ai-title">
                <img src="{{ asset('assets/brand/dobre-ai-icon.png') }}" style="width: 26px; height: 26px; filter: brightness(0) invert(1);" alt="Inteligência Dobre" />
                <span>{{ $name }}</span>
            </div>
            <button class="dobre-ai-close">&times;</button>
        </div>
        <div class="dobre-ai-messages">
            <div class="dobre-ai-msg system">
                {{ $greeting }}
            </div>
        </div>
        <div class="dobre-ai-input-area">
            <input type="text" class="dobre-ai-input" placeholder="Pergunte algo ao sistema...">
            <button class="dobre-ai-mic-btn" title="Falar por voz"><i class="fa-solid fa-microphone"></i></button>
            <button class="dobre-ai-send-btn" title="Enviar"><i class="fa-solid fa-paper-plane"></i></button>
        </div>
    </div>
</div>
