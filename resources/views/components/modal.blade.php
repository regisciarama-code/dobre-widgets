@props([
    'id',
    'title',
    'size' => 'md', // sm, md, lg, xl
    'icon' => null,
])

<div id="{{ $id }}" {{ $attributes->merge(['class' => 'dobre-modal-backdrop']) }}>
    <div class="dobre-modal-dialog dobre-modal-{{ $size }}">
        <div class="dobre-modal-header">
            <h3 class="dobre-modal-title">
                @if($icon)
                    <i class="{{ $icon }}" style="color: var(--dobre-blue);"></i>
                @endif
                {{ $title }}
            </h3>
            <button class="dobre-modal-close" onclick="DobreModal.close('{{ $id }}')">&times;</button>
        </div>
        <div class="dobre-modal-body">
            {{ $slot }}
        </div>
        @if(isset($footer))
            <div class="dobre-modal-footer">
                {{ $footer }}
            </div>
        @endif
    </div>
</div>
