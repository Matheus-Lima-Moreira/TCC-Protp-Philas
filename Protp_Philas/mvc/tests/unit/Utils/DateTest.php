<?php

use App\Utils\Date;
use PHPUnit\Framework\TestCase;

class DateTest extends TestCase {

  /** @var Date Instância da Classe a ser testada */
  protected Date $obDate;

  /**
   * Método responsável por inicializar as varáveis
   */
  protected function setUp(): void {
    parent::setUp();
    $this->obDate = new Date;
  }

  /**
   * Método responsável por prover Date
   */
  public function provedor_de_datas(): array {
    return [
      'Data Completa'             => ['10/10/2010 10:10:10', null, true],
      'Data Sem Segundos'         => ['10/10/2010 10:10', 'd/m/Y H:i', true],
      'Data Sem Hora'             => ['10/10/2010', 'd/m/Y', true],
      'Inválida: Dia inválido'    => ['30/02/2000', 'd/m/Y', false],
      'Inválida: String inválida' => ['aaaaaaaaaa', null, false],
    ];
  }

  /**
   * @dataProvider provedor_de_datas
   * 
   * @test
   */
  public function deveria_validar_as_datas(string $date, ?string $format, bool $expected): void {
    $format = $format ?? 'd/m/Y H:i:s';

    $actual = $this->obDate::isvalid($date, $format);

    $this->assertEquals($expected, $actual);
  }
}
