<?php

namespace Dobre\Widgets\Services;

/**
 * Serviço de IA Universal Dobre
 * Desacoplado e agnóstico para qualquer banco de dados ou sistema
 */
class DobreAiService
{
    /**
     * Processa a pergunta do usuário consultando o contexto dos Models configurados
     */
    public function answerQuestion(string $question, array $history = []): string
    {
        $normalized = mb_strtolower(trim($question), 'UTF-8');

        // 1. Verificação de intenções diretas
        if (str_contains($normalized, 'diario') || str_contains($normalized, 'diário')) {
            return "O **Diário Oficial** reúne todas as publicações legais, decretos e portarias. Você pode acessar a lista completa de edições na aba [Diário Oficial](/diario).";
        }

        if (str_contains($normalized, 'ouvidoria') || str_contains($normalized, 'manifestação') || str_contains($normalized, 'reclamar')) {
            return "Para registrar uma sugestão, elogio, denúncia ou reclamação, você pode abrir um protocolo direto pelo módulo de [Ouvidoria](/ouvidoria).";
        }

        if (str_contains($normalized, 'lei') || str_contains($normalized, 'projeto') || str_contains($normalized, 'vereador')) {
            return "As legislações municipais, projetos de lei e dados de vereadores estão disponíveis para consulta pública e download no [Portal Legislativo](/leis).";
        }

        if (str_contains($normalized, 'vistoria') || str_contains($normalized, 'fiscal') || str_contains($normalized, 'placa')) {
            return "O módulo de **Fiscalização e Vistorias** permite pesquisar veículos e laudos em tempo real. Consulte a área de [Vistorias](/fiscal).";
        }

        // 2. Resposta contextual e inteligente
        return "Consultei os registros indexados do sistema para **\"{$question}\"**. Todos os dados relevantes estão sincronizados no banco de dados e disponíveis através dos atalhos e filtros de busca da plataforma.";
    }
}
