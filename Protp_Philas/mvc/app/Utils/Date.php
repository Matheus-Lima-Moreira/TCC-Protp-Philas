<?php

namespace App\Utils;

use DateTime;

/**
 * Classe responsável por controlar Datas
 */
class Date {

  /**
   * Método responsável por validar datas
   *
   * @param   string  $date
   * @param   string  $format
   *
   * @return  bool
   */
  public static function isvalid(string $date, string $format = 'd/m/Y H:i:s'): bool {
    // CRIA UMA VALIDADOR DE DATAS
    $validator = DateTime::createFromFormat($format, $date);

    // RETORNA SE FOI POSSIVEL CRIAR UMA DATA
    // E ERA A MESMA INFORMADA
    return $validator and $validator->format($format) == $date;
  }
}
