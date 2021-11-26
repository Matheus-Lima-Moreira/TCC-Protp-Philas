<?php
class Conexao {
  private $host;
  private $user;
  private $pass;
  private $db;

  public function __construct(String $db = null, String $host = null, String $user = null, String $pass = null) {
    $this->host = ($host) ?: "localhost";
    $this->user = ($user) ?: "root";
    $this->pass = ($pass) ?: "root";
    $this->db   = ($db)   ?: "tcc_protp_philas";
  }

  public function conectar(&$conn = null) {
    $conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db);

    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      exit;
    }

    return $conn;
  }

  public function consulta(String $sql, mysqli $conn = null) {
    if ($conn === null) $this->conectar($conn);

    // $sql = mysqli_real_escape_string($conn, $sql); // esse treco ta dando erro foda

    $result = mysqli_query($conn, $sql);
    if (mysqli_error($conn)) echo "\n mysql erro: " . mysqli_error($conn);
    mysqli_close($conn);

    return $result;
  }
}
