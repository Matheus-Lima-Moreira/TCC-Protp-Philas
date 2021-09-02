<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;
use \PDOStatement;

// TODO: todos varchar (255)
class User {

  /** @var integer ID do usuário */
  public $id;

  /** @var string Nome do usuário */
  public $nome;

  /** @var integer Telefone do usuário */
  public $telefone;

  /** @var integer CPF do usuário */
  public $cpf;

  /** @var string Login do usuário */
  public $login;

  /** @var string Senha do usuário */
  public $senha;

  /** @var string E-mail do usuário */
  public $email;

  /** @var string Tipo relacionado as permissoões do usuário */
  public $tipo;

  /** @var string Tabela atual no banco de dados da Entidade */
  private static $table = "tb_usuario";

  /**
   * Método responsável por retornar Usuários
   *
   * @param   string  $where   
   * @param   string  $order   
   * @param   string  $limit   
   * @param   string  $fields  
   *
   * @return  PDOStatement     
   */
  public static function getUsers(string $where = null, string $order = null, string $limit = null, string $fields = '*') {
    return (new Database(self::$table))->select($where, $order, $limit, $fields);
  }

  /**
   * Método reponsável por retornar um Usuário com base em seu login
   *
   * @param   string  $login  
   *
   * @return  User          
   */
  public static function getUserByLogin(string $login) {
    return self::getUsers("`login` = '$login'")->fetchObject(self::class);
  }

  /**
   * Método responsável por retornar um Usuário combase no seu id
   *
   * @param   integer  $id  
   *
   * @return  User    
   */
  public static function getUserById(int $id) {
    return self::getUsers("id = $id")->fetchObject(self::class);
  }


  /**
   * Método responsável por cadastrar a intância atual
   *
   * @return  boolean
   */
  public function insert() {
    // INSERE O USUÁRIO NO BANCO DE DADOS
    $this->id = (new Database(self::$table))->insert([
      'nome'     => $this->nome,
      'telefone' => $this->telefone,
      'cpf'      => $this->cpf,
      'login'    => $this->login,
      'senha'    => $this->senha,
      'email'    => $this->email,
      'tipo'     => $this->tipo
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
    // ATUALIZA O USUÁRIO NO BANCO DE DADOS
    return (new Database(self::$table))->update('id = ' . $this->id, [
      'nome'     => $this->nome,
      'telefone' => $this->telefone,
      'cpf'      => $this->cpf,
      'login'    => $this->login,
      'senha'    => $this->senha,
      'email'    => $this->email,
      'tipo'     => $this->tipo
    ]);
  }

  /**
   * Método responsável por excluir a intância atual
   *
   * @return  boolean
   */
  public function delete() {
    // EXCLUI O USUÁRIO DO BANCO DE DADOS
    return (new Database(self::$table))->delete('id = ' . $this->id);
  }
}
