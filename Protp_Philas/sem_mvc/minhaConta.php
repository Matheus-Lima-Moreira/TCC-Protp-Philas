<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Prototipo Philas</title>

    <!-- <base href="http://localhost/TCC/Protp_Philas/" /> -->

    <!-- CSS -->
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- <link href="css/style.css" rel="stylesheet" type="text/css" /> -->

    <!-- javascript -->
    <script src="../../jquery/js/jquery-3.5.1.min.js" type="text/javascript"></script>
    <script src="../../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../js/script.js" type="text/javascript"></script>

    <!-- Custom styles for this template -->
    <link href="../css/sidebars.css" rel="stylesheet">
</head>

<body>

    <?php
    session_start();

    /*1-definindo a conexao -local, usuario, senha e banco de dados*/
    include_once ("Conexao.php");

     	     
		/*2-definindo o comando sql a ser usado */
		 $sql="select * from tb_usuario where id=$_SESSION[id]";
	    
        // /*3-executando o comando sql */ 
         
		        
		/*4-pegando os dados armazenados e exibindo*/
		if($dados=mysqli_fetch_assoc((new Conexao)->consulta($sql))){
			# DEBUG:
            echo "<pre>";
            echo '<b>$dados:</b>'."\n";
            print_r($dados);
            echo "</pre>";
            exit;
            
            
		 	$n= $dados["nome"];
		 	$t= $dados["tel"];
			$cpf= $dados["cpf"];
			$login= $dados["login"];
            $senha= $dados["senha"];
            $email= $dados["email"];

           // print_r($dados); exit;
	
	 	 }
	
	?>

    <!-- Imagens -->
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="people-circle" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
            <path fill-rule="evenodd"
                d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
        </symbol>
    </svg>
    <!-- fim imagens -->

    <header>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <img src="../img/Prop_Philas-Logo.svg" alt="" width="100" height="100" />
                <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <svg class="bi text-white" width="40" height="40">
                        <use xlink:href="#people-circle" />
                    </svg>

                </button>  -->

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link text-white dropdown-toggle" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <svg class="bi me-2" width="40" height="40">
                                <use xlink:href="#people-circle" />
                            </svg>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown03" data-bs-popper="none">
                            <li> <a class="dropdown-item" href="#"> Minha conta </a> </li>
                            <li> <a class="dropdown-item" href="index.html"> Sair </a> </li>
                        </ul>
                    </li>

                </ul>



            </div>
        </nav>

    </header>

    <div class="container d-flex justify-content-center">
        <div class="col-md-7 col-lg-8">
            <br />
            <form name="frmAlterar" id="frmAlterar" action="#" method="POST" class="needs-validation" novalidate>
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label for="firstName" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="firstName" placeholder=""
                            value="<?php echo explode(' ', $_SESSION['nome'], 2)[0]  ?>" name="nome" required />
                        <div class="invalid-feedback">Nome é obrigatório.</div>
                    </div>

                    <div class="col-sm-6">
                        <label for="lastName" class="form-label">Sobrenome</label>
                        <input type="text" class="form-control" id="lastName" placeholder=""
                            value="<?php echo explode(' ', $_SESSION['nome'], 2)[1]  ?>" name="sobrenome" required />
                        <div class="invalid-feedback">Sobrenome é obrigatório.</div>
                    </div>

                    <div class="col-sm-6">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="password1" placeholder="aBc_123" value="<?php echo $senha ?>" name="senha"
                            required />
                        <div class="invalid-feedback">Senha é obrigatória.</div>
                    </div>

                    <div class="col-sm-6">
                        <label for="password" class="form-label">Confirmar senha</label>
                        <input type="password" class="form-control" id="password2" placeholder="aBc_123" value="<?php echo $senha ?>"
                            name="confirmar_senha" required />
                        <div class="invalid-feedback">Senha é obrigatória.</div>
                    </div>

                    <div class="col-sm-6">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" maxlength="11" class="form-control" id="telefone"
                            placeholder="Ex: 17991061050" value="<?php echo $t ?>" name="telefone" required />
                        <div class="invalid-feedback">Telefone é obrigatório.</div>
                    </div>

                    <div class="col-sm-6">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" pattern="\d{3}\.?\d{3}\.?\d{3}-?\d{2}" maxlength="14" class="form-control"
                            id="cpf" placeholder="Ex: 52810466084" value="<?php echo $cpf ?>" name="cpf" required />
                        <div class="invalid-feedback">CPF é obrigatório.</div>
                    </div>

                    <div class="col-12">
                        <label for="username" class="form-label">Usuário</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text">@</span>
                            <input type="text" class="form-control" id="username" placeholder="Username" value="<?php echo $login ?>" name="usuario"
                                required />
                            <!--aprender a usar pattern="[A-Za-z]{3}" para validar os dados-->
                            <div class="invalid-feedback">Usuário é obrigatório.</div>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="you@example.com" value="<?php echo $email ?>"
                            name="email" required />
                        <div class="invalid-feedback">Coloque um email válido para contato.</div>
                    </div>

                    <button class="w-100 btn btn-dark btn-lg" name="cadastrar" value="Cadastrar"
                        type="submit">Alterar</button>
            </form>
        </div>

    </div>
    </div>

    
    <footer class="pt-4 text-muted text-center text-small">
        <!-- <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacidade</a></li>
                <li class="list-inline-item"><a href="#">Termos</a></li>
                <li class="list-inline-item"><a href="#">Suporte</a></li>
            </ul> -->
    </footer>

    <script src="../js/form-validation.js" type="text/javascript"></script>

    <script>
    form = document.getElementById("frmAlterar");

    form.addEventListener(
        "submit",
        function(event) {
            p1 = document.getElementById("password1");
            p2 = document.getElementById("password2");

            if (p1.value != p2.value) {
                p2.classList.add("invalido");
                event.preventDefault();
                event.stopPropagation();
            }

            form.classList.add("was-validated");
        },
        false
    );
    </script>

</body>

</html>