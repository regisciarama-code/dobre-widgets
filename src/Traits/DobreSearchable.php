<?php

namespace Dobre\Widgets\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait DobreSearchable
 * Torna qualquer Model Eloquent pesquisável pelo Autocomplete e IA Dobre
 */
trait DobreSearchable
{
    /**
     * Campos pesquisáveis padrão se não especificado no Model
     */
    public function getDobreSearchableFields(): array
    {
        if (property_exists($this, 'dobreSearchable') && is_array($this->dobreSearchable)) {
            return $this->dobreSearchable;
        }

        // Fallback inteligente para campos comuns em sistemas brasileiros
        return array_intersect(
            $this->fillable ?: [],
            ['nome', 'name', 'titulo', 'title', 'descricao', 'description', 'ementa', 'cpf', 'cnpj', 'placa', 'protocolo', 'numero', 'assunto', 'email']
        ) ?: ['id'];
    }

    /**
     * Scope para busca com operador LIKE em múltiplos campos
     */
    public function scopeDobreSearch(Builder $query, string $term): Builder
    {
        $term = trim($term);
        if (empty($term)) {
            return $query;
        }

        $fields = $this->getDobreSearchableFields();

        return $query->where(function (Builder $q) use ($fields, $term) {
            foreach ($fields as $field) {
                $q->orWhere($field, 'LIKE', "%{$term}%");
            }
        });
    }

    /**
     * Formata o registro para o padrão JSON do Autocomplete
     */
    public function toDobreAutocompletePayload(?string $primaryField = null): array
    {
        $field = $primaryField ?: ($this->dobrePrimaryField ?? $this->getDobreSearchableFields()[0] ?? 'id');
        $label = $this->{$field} ?? "Registro #{$this->getKey()}";

        return [
            'id' => $this->getKey(),
            'label' => (string) $label,
            'value' => (string) $label,
            'badge' => class_basename($this),
            'model' => get_class($this),
            'url' => method_exists($this, 'dobreUrl') ? $this->dobreUrl() : null,
            'meta' => [
                'created_at' => $this->created_at ? $this->created_at->format('d/m/Y') : null,
            ]
        ];
    }
}
