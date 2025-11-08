<?php

// 2. A Classe Principal (Classe Sendo Testada)
// Ela não sabe "como" pegar a data, apenas que seu "provedor"
// (a dependência) sabe.
class Calendario
{
    private $provedorDeData;

    public function __construct(ProvedorDeDataInterface $provedorDeData)
    {
        $this->provedorDeData = $provedorDeData;
    }

    /**
     * Verifica se a data fornecida pelo provedor é um fim de semana.
     */
    public function hojeEhFimDeSemana(): bool
    {
        // Pega a data "de hoje" do provedor
        $hoje = $this->provedorDeData->getDataAtual();

        // Pega o número do dia da semana (formato 'N')
        // 1 = Segunda ... 6 = Sábado, 7 = Domingo
        $diaDaSemana = $hoje->format('N');

        // Retorna true se for 6 ou 7
        return in_array($diaDaSemana, ['6', '7']);
    }
}

