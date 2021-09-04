<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;
use \PDOStatement;

class Schedule {

  /** @var integer ID do Atendimento */
  public $id;

  /** @var integer Relação ao Motivo do Atendimento */
  public $cod_motivo;

  /** @var string Descrição do Atendimento */
  public $descricao;

  /** @var integer Tempo previsto do Atendimento */
  public $tempo_previsto;

  /** @var string Data que foi marcado (ou atualizado) o Atendimento */
  public $data_marcada;

  /** @var string Data que foi inicado o Atendimento */
  public $data_iniciada;

  /** @var string Data que foi finalizado o Atendimento */
  public $data_finalizada;

  /** @var integer Relação ao Usuário (Atendido) participante do Atendimento */
  public $cod_atendido;

  /** @var integer Relação ao Usuário (Atendente) participante do Atendimento */
  public $cod_atendente;

  /** @var string Tabela atual no banco de dados da Entidade */
  private static $table = "atendimento";

  /**
   * Método responsável por retornar Atendimentos
   *
   * @param   string  $where   
   * @param   string  $order   
   * @param   string  $limit   
   * @param   string  $fields  
   *
   * @return  PDOStatement          
   */
  public static function getResons(string $where = null, string $order = null, string $limit = null, string $fields = '*') {
    return (new Database(self::$table))->select($where, $order, $limit, $fields);
  }

  /**
   * Método responsável por retornar um Motivo combase no seu id
   *
   * @param   integer  $id  
   *
   * @return  Schedule    
   */
  public static function getResonById(int $id) {
    return self::getResons("id = $id")->fetchObject(self::class);
  }


  /**
   * Método responsável por cadastrar a intância atual
   *
   * @return  boolean
   */
  public function insert() {
    // INSERE O ATEDIMENTO NO BANCO DE DADOS
    $this->id = (new Database(self::$table))->insert([
      'descricao'       => $this->descricao,
      'cod_motivo'      => $this->cod_motivo,
      'tempo_previsto'  => $this->tempo_previsto,
      'data_marcada'    => $this->data_marcada,
      'data_iniciada'   => $this->data_iniciada,
      'data_finalizada' => $this->data_finalizada,
      'cod_atendido'    => $this->cod_atendido,
      'cod_atendente'   => $this->cod_atendente
    ]);

    // SUCESSO
    return true;
  }

  /**
   * Método responsável por atualizar a intância atual
   *
   * @return  boolean
   */
  public function update() {
    // ATUALIZA O ATEDIMENTO NO BANCO DE DADOS
    return (new Database(self::$table))->update('id = ' . $this->id, [
      'descricao'       => $this->descricao,
      'cod_motivo'      => $this->cod_motivo,
      'tempo_previsto'  => $this->tempo_previsto,
      'data_marcada'    => $this->data_marcada,
      'data_iniciada'   => $this->data_iniciada,
      'data_finalizada' => $this->data_finalizada,
      'cod_atendido'    => $this->cod_atendido,
      'cod_atendente'   => $this->cod_atendente
    ]);
  }

  /**
   * Método responsável por excluir a intância atual
   *
   * @return  boolean
   */
  public function delete() {
    // EXCLUI O ATEDIMENTO DO BANCO DE DADOS
    return (new Database(self::$table))->delete('id = ' . $this->id);
  }
}
