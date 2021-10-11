<?php

namespace App\Utils;

use App\Utils\View;

/**
 * Classe responsável por controlar alertas para o usuário
 */
class Alert {

  /**
   * Método responsável por retornar uma mensagem de erro
   * 
   * @param   string  $message
   *   
   * @return  string            
   */
  public static function getError($message) {
    return View::render('Alert/status', [
      'tipo'     => 'danger',
      'mensagem' => $message
    ]);
  }

  /**
   * Método responsável por retornar uma mensagem de sucesso
   * 
   * @param   string  $message 
   *  
   * @return  string            
   */
  public static function getSuccess($message) {
    return View::render('Alert/status', [
      'tipo'     => 'success',
      'mensagem' => $message
    ]);
  }
}
