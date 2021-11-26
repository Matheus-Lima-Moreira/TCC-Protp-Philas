<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors" />
    <meta name="generator" content="Hugo 0.84.0" />
    <title>Cadastrar Usuário</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/checkout/" />

    <!-- Bootstrap core CSS -->
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <!-- style para validação -->
    <link href="../css/form-validation.css" rel="stylesheet" />
</head>
<style>
    .invalido {
        border-color: #dc3545 !important;
        padding-right: calc(1.5em + 0.75rem) !important;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e") !important;
        background-repeat: no-repeat !important;
        background-position: right calc(0.375em + 0.1875rem) center !important;
        background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem) !important;
    }

    .invalido:focus {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 0.25rem rgb(220 53 69 / 25%) !important;
    }

    .invalido+.invalid-feedback {
        display: block;
    }
</style>

<body class="bg-light">
    <div class="container">
        <main>
            <div class="py-5 text-center">
                <!-- <img class="d-block mx-auto" src="img/Prop_Philas-Logo.svg" alt="" width="150" height="150" /> -->
            </div>

            <div class="d-flex justify-content-center">
                <div class="col-md-7 col-lg-8">
                    <h2 class="mb-3 text-center">Preencha com seus dados</h2>
                    <br />
                    <form name="frmCadastro" id="frmCadastro" action="cadastrarAção.php" method="POST" class="needs-validation" novalidate>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="firstName" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="firstName" placeholder="" value="" name="nome" required />
                                <div class="invalid-feedback">Nome é obrigatório.</div>
                            </div>

                            <div class="col-sm-6">
                                <label for="lastName" class="form-label">Sobrenome</label>
                                <input type="text" class="form-control" id="lastName" placeholder="" value="" name="sobrenome" required />
                                <div class="invalid-feedback">Sobrenome é obrigatório.</div>
                            </div>

                            <div class="col-sm-6">
                                <label for="password" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="password1" placeholder="aBc_123" name="senha" required />
                                <div class="invalid-feedback">Senha é obrigatória.</div>
                            </div>

                            <div class="col-sm-6">
                                <label for="password" class="form-label">Confirmar senha</label>
                                <input type="password" class="form-control" id="password2" placeholder="aBc_123" name="confirmar_senha" required />
                                <div class="invalid-feedback">Senha é obrigatória.</div>
                            </div>

                            <div class="col-sm-6">
                                <label for="telefone" class="form-label">Telefone</label>
                                <input type="text" maxlength="11" class="form-control" id="password" placeholder="Ex: 17991061050" value="" name="telefone" required />
                                <div class="invalid-feedback">Telefone é obrigatório.</div>
                            </div>

                            <div class="col-sm-6">
                                <label for="cpf" class="form-label">CPF</label>
                                <input type="text" pattern="\d{3}\.?\d{3}\.?\d{3}-?\d{2}" maxlength="14" class="form-control" id="password" placeholder="Ex: 52810466084" value="" name="cpf" required />
                                <div class="invalid-feedback">CPF é obrigatório.</div>
                            </div>

                            <div class="col-12">
                                <label for="username" class="form-label">Usuário</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text">@</span>
                                    <input type="text" class="form-control" id="username" placeholder="Username" name="usuario" required />
                                    <!--aprender a usar pattern="[A-Za-z]{3}" para validar os dados-->
                                    <div class="invalid-feedback">Usuário é obrigatório.</div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="you@example.com" value="" name="email" required />
                                <div class="invalid-feedback">Coloque um email válido para contato.</div>
                            </div>
                        </div>

                        <hr class="my-4" />

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="same-address" />
                            <label class="form-check-label" for="same-address">Receber noticias no email</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="save-info" required />
                            <label class="form-check-label" for="save-info">Concordo com os termos de uso</label>
                        </div>

                        <hr class="my-4" />

                        <button class="w-100 btn btn-dark btn-lg" name="cadastrar" value="Cadastrar" type="submit">Confirmar</button>
                    </form>
                </div>
            </div>
        </main>

        <footer class="my-5 pt-5 text-muted text-center text-small">
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacidade</a></li>
                <li class="list-inline-item"><a href="#">Termos</a></li>
                <li class="list-inline-item"><a href="#">Suporte</a></li>
            </ul>
        </footer>
    </div>

    <script src="../../bootstrap/js/bootstrap.bundle.min.js" type="text/javascript"></script>

    <script src="../js/form-validation.js" type="text/javascript"></script>

    <script>
        form = document.getElementById("frmCadastro");

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