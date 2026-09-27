<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Padrão Dobre - Configurações Gerais do Pacote
    |--------------------------------------------------------------------------
    */

    'app_name' => env('DOBRE_APP_NAME', config('app.name', 'Sistema Dobre')),
    'version' => env('DOBRE_SYSTEM_VERSION', '2.5.0'),

    // Branding Oficial
    'branding' => [
        'company_name' => 'Dobre Tecnologia',
        'url' => 'https://dobretecnologia.com',
        'badge' => 'Padrão Dobre IHC',
        'show_footer_brand' => true,
    ],

    // Modelos pesquisáveis pelo Autocomplete Universal e Busca Global
    'searchable_models' => [
        // 'usuarios' => \App\Models\User::class,
        // 'leis' => \App\Models\Lei::class,
        // 'vistorias' => \App\Models\Vistoria::class,
        // 'manifestacoes' => \App\Models\Manifestacao::class,
    ],

    // Rota e Middleware da API Dobre
    'api' => [
        'prefix' => 'dobre-api',
        'middleware' => ['web'],
    ],

    // Configurações do Assistente de IA Universal
    'ai' => [
        'enabled' => true,
        'name' => 'Dobre IA',
        'endpoint' => '/dobre-api/ai/ask',
        'default_greeting' => 'Olá! Sou o assistente de IA da Dobre Tecnologia. Como posso ajudar com os registros do sistema hoje?',
    ],
];
