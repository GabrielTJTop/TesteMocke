<?php

use PHPUnit\Framework\TestCase;

require_once 'ProvedorDeDataInterface.php';
require_once 'Calendario.php';

class CalendarioTest extends TestCase
{
    /**
     * Teste 1: Deve retornar FALSE para uma Quarta-feira
     */
    public function testDeveRetornarFalseParaDiaDeSemana()
    {
        // --- A MÁGICA DO MOCK ---

        // 1. Criamos um objeto de data controlado (uma Quarta-feira)
        // Esta é a data que "falsificamos" como sendo "hoje"
        $dataFalsa = new \DateTimeImmutable('2025-10-29'); // Uma Quarta-feira

        // 2. Criamos um "mock" (imitação) da nossa interface
        $mockProvedor = $this->createMock(ProvedorDeDataInterface::class);

        // 3. Programamos o mock:
        // "QUANDO o método 'getDataAtual' for chamado,
        //  ENTÃO retorne o nosso objeto $dataFalsa"
        $mockProvedor->method('getDataAtual')
                     ->willReturn($dataFalsa);

        // --- FIM DO MOCK ---

        // 4. Injetamos o MOCK (objeto falso) dentro da classe Calendario
        $calendario = new Calendario($mockProvedor);

        // 5. Executamos o teste e verificamos (Assert)
        // A classe Calendario vai pegar a Quarta-feira do mock
        // e o método deve retornar false.
        $this->assertFalse($calendario->hojeEhFimDeSemana());
    }

    /**
     * Teste 2: Deve retornar TRUE para um Sábado
     */
    public function testDeveRetornarTrueParaFimDeSemana()
    {
        // 1. Criamos um objeto de data controlado (um Sábado)
        $dataFalsa = new \DateTimeImmutable('2025-10-25'); // Um Sábado

        // 2. Criamos o mock
        $mockProvedor = $this->createMock(ProvedorDeDataInterface::class);

        // 3. Programamos o mock para retornar o Sábado
        $mockProvedor->method('getDataAtual')
                     ->willReturn($dataFalsa);

        // 4. Injetamos o mock
        $calendario = new Calendario($mockProvedor);

        // 5. Verificamos
        // A classe Calendario vai pegar o Sábado do mock
        // e o método deve retornar true.
        $this->assertTrue($calendario->hojeEhFimDeSemana());
    }
}
