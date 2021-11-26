<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.84.0">
        <title>Login Philas</title>

    </head>
    <body>
        <?php
            /*pegando os dados vindos do formulario */
            $usuario=$_POST["usuario"];
            $senha=$_POST["senha"];
        
            /*1- definindo a conexao - local, usuario, senha e banco de dados*/
            include_once "connection.php";

            /*2- verificando se a conexao foi estabelecida */
            if ($conn==true) {
            
                /*3-definindo o comando sql a ser usado */
                $sql="select *from tb_usuario where (login='$usuario' or email='$usuario') and senha='$senha'"; // FIXME: NOME???? pq nn o login??
                // $sql = "SELECT * FROM tb_usuario WHERE (login='$usuario' OR email='$usuario') AND senha='$senha';";

                /*4-executando o comando sql */
                $verifica=mysqli_query($conn, $sql);
                        
                /*5- verificando se encontrou registro */
                if (mysqli_num_rows($verifica)<=0) {
                    //echo "Usuário nao encontrado";
                    header ("location:index.html");
                    //echo $sql;
                } else {
                    //echo "Usuário encontrado";
                    if ($dados=mysqli_fetch_assoc($verifica)) {
                        $id=$dados["id"];
                        $n=$dados["nome"];
                        $t=$dados["tipo"];
                    
                        session_start();
                        
                        // $_SESSION["user_id"]=$id;
                        // $_SESSION["nome"]=$n;
                        // $_SESSION["tipo"]=$t;
                
                         header("location:home.php");
                        //header("location:createSchedule");
                    }
                }
            }
        ?>
    </body>
</html>
<!-- lol olha o Alias que estava aparecendo aqui kksksksks -->
<!-- Alias /TCC "C:/Users/Danilo_xD/OneDrive - Etec Centro Paula Souza/Trabaios Compartilhados/3°/TCC/Code/" -->