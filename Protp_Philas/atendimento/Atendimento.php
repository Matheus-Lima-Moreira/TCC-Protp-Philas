<?php

require_once(__DIR__ . "\\..\\Conexao.php");

// $A = new Atendimento();
// $A->criar($A);

class Atendimento {
  public $descricao;
  public $tempo_previsto;
  public $data_marcada;
  public $data_iniciada;
  public $data_finalizada;
  public $cod_motivo;
  public $cod_atendido;
  public $cod_atendente;

  public function criar(Atendimento $Atendimento) {
    // (new Conexao())->conectar($conn);

    $sql = "INSERT INTO `tb_atendimento`
    (`descricao`, `tempo_previsto`, `data_marcada`, `data_iniciada`, `data_finalizada`, `cod_motivo`, `cod_atendido`, `cod_atendente`)
    VALUES
    (
      " . (($Atendimento->descricao)       ? "'$Atendimento->descricao'"       : "NULL") . ",
      " . (($Atendimento->tempo_previsto)  ? "$Atendimento->tempo_previsto"    : "NULL") . ",
      " . (($Atendimento->data_marcada)    ? "'$Atendimento->data_marcada'"    : "NULL") . ",
      " . (($Atendimento->data_iniciada)   ? "'$Atendimento->data_iniciada'"   : "NULL") . ",
      " . (($Atendimento->data_finalizada) ? "'$Atendimento->data_finalizada'" : "NULL") . ",
      " . (($Atendimento->cod_motivo)      ? "$Atendimento->cod_motivo"        : "NULL") . ",
      " . (($Atendimento->cod_atendido)    ? "$Atendimento->cod_atendido"      : "NULL") . ",
      " . (($Atendimento->cod_atendente)   ? "$Atendimento->cod_atendente"     : "NULL") . "
    )";

    /*
      $sql = mysqli_real_escape_string($conn, $sql);
  
      mysqli_query($conn, $sql);

      mysqli_close($conn);
    */

    (new Conexao())->consulta($sql);
  }

  public function ler() {
    // TODO: lol
  }

  public function atualizar() {
    // TODO: lol 
  }

  public function deletar() {
    // TODO: lol
  }
}
