<?php

// 1. A Abstração (Interface)
// Define um "contrato": qualquer classe que implementar isto
// Deve ter um método que retorna a data atual.
interface ProvedorDeDataInterface
{
    public function getDataAtual(): \DateTimeImmutable;
}