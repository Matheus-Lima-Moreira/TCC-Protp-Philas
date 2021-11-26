<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>Protopito Philas</title>

        <!-- <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> -->

        <link href="css/style.css" rel="stylesheet" type="text/css" />

        <script src="../../jquery/js/jquery-3.5.1.min.js" type="text/javascript"></script>
        <!-- <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script> -->

        <script src="../js/schedules.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container">
            <form name="frmCadatrar" id="frmCadastrar" action="" method="POST">
                <div>
                    <select name="slcMotivo" id="slcMotivo" autocomplete="off">
                        <option value="" disabled selected>Motivo</option>
                        <?php
                        include_once "connection.php";

                        $sql = "SELECT * FROM `motivo`";
                        
                        $query = mysqli_query($conn, $sql);

                        while ($dados = mysqli_fetch_assoc($query)){
                            $cod = $dados["id"];
                            $descricao = $dados["descricao"];
                            $tempo_previsto = $dados["tempo_previsto"];
                            // FIXME: nn botar no data-, usuario pode alterar e fuder tudo, Jquery consulta pra validar
                        ?>
                            <option value=<?php echo "$cod"?> data-tempo-previsto=<?php echo "$tempo_previsto"?>> <?php echo $descricao?> </option>
                        <?php
                        }
                        ?>
                        <option value=""> Outro </option>
                    </select>
                </div>

                <div>
                    <textarea name="edtOutro" id="edtOutro" placeholder="Descreva seu Motivo…" style="display: none;"></textarea>
                </div>

                <div>
                    <!-- TODO: altera pra input normal com verificação no JS, responsividade -->
                    <!-- TODO: pra validar, buscar no banco os tempos previstos. Caso Seja outro, ignora ate o retorno do adm, quando retornar busca dnv -->
                    <input name="edtData" id="edtData" type="datetime-local" />
                </div>

                <div id="Participantes" style="display: none;">
                    <div>
                        <input name="edtAtendido" id="edtAtendido" type="text" placeholder="Atendido" />
                    </div>

                    <div>
                        <input name="edtAtendente" id="edtAtendente" type="text" placeholder="Atendente" />
                    </div>
                </div>

                <div>
                    <div>
                        <!-- TODO: melhores textos -->
                        <button name="btnDef" id="btnDef" type="button" data-tool-tip="Difinir Atendendido e/ou Atendente?">Def Part</button>
                        <!-- </div>
          <div> -->
                        <button name="btnOk" id="btnOk" type="submit">Ok</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
<?php
// TODO: Terminar... (Pegar do banco os temposprevistos)
if (isset($_POST["btnOk"])) {
    session_start();

    $slcMotivo = $_POST["slcMotivo"] ? : "NULL";

    $edtOutro = $_POST["edtOutro"] ? : "NULL";
    $edtData = $_POST["edtData"] ? : "NULL";
    $edtAtendido = $_POST["edtAtendido"] ? : $_SESSION["user_id"]; // FIXME:
    $edtAtendente = $_POST["edtAtendente"] ? : "NULL";
    
    $data = [
      "_descricao"=>$edtOutro,
      "_tempo_previsto"=>"NULL",
      "_data_marcada"=>$edtData,
      "_data_iniciada"=>"NULL",
      "_data_finalizada"=>"NULL",
      "_cod_motivo"=>$slcMotivo,
      "_cod_atendido"=>$edtAtendido,
      "_cod_atendente"=>$edtAtendente
    ];

    
    $URL = "http://localhost/TCC/Protp_Philas/schedules";
    
    $ch =  curl_init($URL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);

    $headers = array('Accept: application/json','Content-Type: application/json');
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $post = tmpfile();
    fwrite($post, $data = json_encode($data));
    fseek($post, 0); //??

    curl_setopt($ch, CURLOPT_INFILE, $post);
    curl_setopt($ch, CURLOPT_INFILESIZE, strlen($data)); //?

    echo curl_exec($ch);
    echo curl_getinfo($ch, CURLINFO_HTTP_CODE);

    fclose($post);
    curl_close($ch);
    
}

?>