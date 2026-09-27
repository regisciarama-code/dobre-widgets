<?php

namespace Dobre\Widgets\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Dobre\Widgets\Services\DobreAiService;

class DobreApiController extends Controller
{
    /**
     * Autocomplete universal para qualquer Model
     */
    public function autocomplete(Request $request)
    {
        $term = $request->input('q', '');
        $modelClass = $request->input('model');
        $field = $request->input('field');
        $limit = min((int) $request->input('limit', 15), 50);

        if (empty($term) || strlen($term) < 1) {
            return response()->json([]);
        }

        // Se o model for informado e existir
        if ($modelClass && class_exists($modelClass)) {
            $query = $modelClass::query();

            if (method_exists($modelClass, 'scopeDobreSearch')) {
                $results = $query->dobreSearch($term)->limit($limit)->get();
                $payload = $results->map(fn($item) => $item->toDobreAutocompletePayload($field));
            } else {
                $searchField = $field ?: 'nome';
                $results = $query->where($searchField, 'LIKE', "%{$term}%")->limit($limit)->get();
                $payload = $results->map(function($item) use ($searchField, $modelClass) {
                    return [
                        'id' => $item->id ?? null,
                        'label' => (string) ($item->{$searchField} ?? 'Registro'),
                        'value' => (string) ($item->{$searchField} ?? ''),
                        'badge' => class_basename($modelClass),
                    ];
                });
            }

            return response()->json($payload);
        }

        // Se nenhum model específico for passado, busca nos models configurados
        $configuredModels = config('dobre-widgets.searchable_models', []);
        $allResults = [];

        foreach ($configuredModels as $key => $cls) {
            if (class_exists($cls)) {
                $items = $cls::query();
                if (method_exists($cls, 'scopeDobreSearch')) {
                    $items = $items->dobreSearch($term)->limit(5)->get();
                    foreach ($items as $it) {
                        $allResults[] = $it->toDobreAutocompletePayload();
                    }
                }
            }
        }

        return response()->json($allResults);
    }

    /**
     * Busca global em todas as categorias (Estilo Dobre)
     */
    public function globalSearch(Request $request)
    {
        $term = $request->input('q', '');
        if (empty($term)) {
            return response()->json([]);
        }

        $results = [];
        $configuredModels = config('dobre-widgets.searchable_models', []);

        foreach ($configuredModels as $categoryName => $modelClass) {
            if (class_exists($modelClass)) {
                $query = $modelClass::query();
                if (method_exists($modelClass, 'scopeDobreSearch')) {
                    $items = $query->dobreSearch($term)->limit(5)->get();
                    foreach ($items as $item) {
                        $payload = $item->toDobreAutocompletePayload();
                        $payload['category'] = is_string($categoryName) ? ucfirst($categoryName) : class_basename($modelClass);
                        $results[] = $payload;
                    }
                }
            }
        }

        return response()->json($results);
    }

    /**
     * Endpoint do Assistente de IA Universal
     */
    public function askAi(Request $request, DobreAiService $aiService)
    {
        $request->validate([
            'question' => 'required|string|max:1000',
            'history' => 'nullable|array'
        ]);

        $question = $request->input('question');
        $history = $request->input('history', []);

        $answer = $aiService->answerQuestion($question, $history);

        return response()->json([
            'success' => true,
            'answer' => $answer
        ]);
    }
}
