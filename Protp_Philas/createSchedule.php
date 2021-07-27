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

        <script src="js/script.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container">
            <form name="frmCadatrar" id="frmCadastrar" action="" method="POST">
                <div>
                    <select name="slcMotivo" id="slcMotivo">
                        <option value="" disabled selected>Motivo</option>
                        <option value="boletim"> Boletim </option>
                        <option value="matriula"> Matícula </option>
                        <option value="outro"> Outro </option>
                    </select>
                </div>

                <div>
                    <textarea name="edtOutro" id="edtOutro" placeholder="Descreva seu Motivo…"></textarea>
                </div>

                <div>
                    <!-- TODO: altera pra input normal com verificação no JS, responsividade -->
                    <input name="edtData" id="edtData" type="datetime-local" />
                </div>

                <div id="Participsantes">
                    <div>
                        <input name="edtAtendido" id="edtAtendido" type="text" placeholder="Atendido" />
                    </div>

                    <div>
                        <input name="edtAtendente" id="edtAtendente" type="text" placeholder="Atendente" />
                    </div>
                </div>

                <div>
                    <div>
                        <button name="btnDef" id="btnDef" type="button">Def Part</button>
                        <!-- </div>
          <div> -->
                        <button name="btnOk" id="btnOk" type="submit">Ok</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>