@props([
    'name' => 'arquivos[]',
    'multiple' => true,
    'accept' => 'image/*,application/pdf,video/*',
    'maxSize' => 20, // MB
    'title' => 'Arraste e solte seus arquivos aqui',
    'hint' => 'Suporta imagens, PDFs e vídeos até 20MB',
])

<div class="dobre-upload-wrapper">
    <div 
        class="dobre-upload-zone" 
        data-dobre-upload="true"
        data-name="{{ $name }}"
        data-multiple="{{ $multiple ? 'true' : 'false' }}"
        data-accept="{{ $accept }}"
        data-max-size="{{ $maxSize }}"
        {{ $attributes }}
    >
        <i class="fa-solid fa-cloud-arrow-up dobre-upload-icon"></i>
        <div class="dobre-upload-title">{{ $title }}</div>
        <div class="dobre-upload-hint">{{ $hint }}</div>
    </div>
    <div class="dobre-preview-grid"></div>
</div>
