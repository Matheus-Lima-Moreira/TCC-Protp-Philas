<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>Protopito Philas</title>

        <!-- <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> -->

        <link href="css/style.css" rel="stylesheet" type="text/css" />

        <script src="../jquery/js/jquery-3.5.1.min.js" type="text/javascript"></script>
        <!-- <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script> -->

        <script src="js/users.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container">
            <form name="frmCadatrar" id="frmCadastrar" action="" method="POST">
                <div>
                    <input name="edtNome" id="edtNome" type="text" placeholder="Nome Completo" required />
                </div>

                <div>
                    <div>
                        <input name="edtEmail" id="edtEmail" type="email" placeholder="E-mail" required />
                    <!-- </div>
                    <div> -->
                        <button name="btnUsuario" id="btnUsuario" type="button" data-tool-tip="Logar com um Usuário?">?</button>
                    </div>
                </div>

                <div>
                    <input name="edtUsuario" id="edtUsuario" type="text" placeholder="Usuário" />
                </div>

                <div>
                    <div>
                        <input name="edtTelefone" id="edtTelefone" type="tel" placeholder="Telefone" />
                        <!-- </div>
        <div> -->
                        <input name="edtCPF" id="edtCPF" type="number" placeholder="CPF" required />
                    </div>
                </div>

                <div>
                    <input name="edtSenha" id="edtSenha" type="password" placeholder="Senha" autocomplete="off" required />
                </div>

                <div>
                    <input name="edtConfirmarSenha" id="edtConfirmarSenha" type="password" placeholder="Confrimar Senha" autocomplete="off" required />
                </div>

                <div>
                    <div>
                        <input name="chkTermos" id="chkTermos" type="checkbox" />
                        <label name="lblTermos" id="lblTermos" for="chkTermos"> Termos de serviço </label>
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
######    ALTERAR PRO JQUERY .ajax??

#Poderia ser qualquer $_POST, sim to com preguiça de colocar para todos os campos
if (isset($_POST["btnOk"])) {
    $edtNome = $_POST["edtNome"];
    $edtEmail = $_POST["edtEmail"];
    $edtUsuario = $_POST["edtUsuario"];
    $edtTelefone = $_POST["edtTelefone"];
    $edtCPF = $_POST["edtCPF"];
    $edtSenha = $_POST["edtSenha"];
    $edtConfirmarSenha = $_POST["edtConfirmarSenha"];

    $data = [
      "_nome"=>$edtNome,
      "_telefone"=>$edtTelefone,
      "_cpf"=>$edtCPF,
      "_login"=>$edtUsuario,
      "_senha"=>$edtSenha,
      "_email"=>$edtEmail,
      "_tipo"=>"Comum"
    ];
    
    $URL = "http://localhost/TCC/Protp_Philas/users";
    
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