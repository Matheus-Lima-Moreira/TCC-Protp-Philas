<!doctype html>
<html>
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>Cadastro de Usuário</title>
     
</head>	
<body>
    	
		 <div class="container">
		 
		 <?php
		
		/*pegando os dados vindos do formulario */
		 $n=$_POST["nome"];
		 $s=$_POST["sobrenome"];

         $t=$_POST["telefone"];

         $cpf=$_POST["cpf"];

         $u=$_POST["usuario"];

         $se=$_POST["senha"];

         $e=$_POST["email"];
		
		/*1- definindo a conexao - local, usuario, senha e banco de dados*/
	    include_once ("connection.php");

		/*2-definindo o comando sql a ser usado */
	     $sql="INSERT into tb_usuario(nome, telefone, cpf, login, senha, email, tipo)
		 values('$n $s','$t','$cpf','$u','$se','$e','Comum')";
        
		/*3-executando o comando sql */ 
        $result= mysqli_query($conn, $sql);
		  
		/*4-conferindo se o registro foi inserido*/  
		 if($result==true){
					 
		  echo "<h3> Dados gravados com sucesso </h3> ";
			 
		 }else{
			 echo "<h3> Não foi possivel a gravacao </h3>";
		 }
			 
		 
         
         ?> 
		 </div>
</body>
</html>