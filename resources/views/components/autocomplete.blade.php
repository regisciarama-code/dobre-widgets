@props([
    'name',
    'label' => null,
    'placeholder' => 'Digite para pesquisar...',
    'model' => null,
    'field' => 'nome',
    'endpoint' => '/dobre-api/autocomplete',
    'value' => null,
    'required' => false,
])

<div class="dobre-form-group">
    @if($label)
        <label class="dobre-label {{ $required ? 'dobre-label-required' : '' }}">{{ $label }}</label>
    @endif

    <div class="dobre-autocomplete-wrapper">
        <input 
            type="text"
            name="{{ $name }}"
            value="{{ $value }}"
            placeholder="{{ $placeholder }}"
            data-dobre-autocomplete="true"
            data-model="{{ $model }}"
            data-field="{{ $field }}"
            data-endpoint="{{ $endpoint }}"
            {{ $required ? 'required' : '' }}
            {{ $attributes->merge(['class' => 'dobre-input']) }}
            autocomplete="off"
        >
    </div>
</div>
