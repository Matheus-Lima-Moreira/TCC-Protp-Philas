<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Agendar horario</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/checkout/">

    

    <!-- Bootstrap core CSS -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <script src="js/script.js" type="text/javascript"></script>

    <!-- Custom styles for this template -->
    <link href="css/form-validation.css" rel="stylesheet">
    
  </head>
  <body class="bg-light">
    
 <div class="container">
  <main>
        <div class="py-5 text-center">
          <!-- <img class="d-block mx-auto " src="img/Prop_Philas-Logo.svg" alt="" width="150" height="150"> -->
        </div>

        <div class="d-flex justify-content-center">
          <div class="col-md-7 col-lg-8">
            <h2 class="mb-3 text-center">Agendar Horário</h2> </br>
            <form class="needs-validation" novalidate>
              <div class="row g-3">

                <div class="col-sm-6">
                  <label for="firstName" class="form-label">Nome</label>
                  <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
                  <div class="invalid-feedback">
                    Nome é obrigatório.
                  </div>
                </div>

                <div class="col-sm-6">
                  <label for="lastName" class="form-label">Sobrenome</label>
                  <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
                  <div class="invalid-feedback">
                    Sobrenome é obrigatório.
                  </div>
                </div>

                <div class="col-12">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" placeholder="you@example.com" value="" required>
                  <div class="invalid-feedback">
                    Coloque um email válido para contato.
                  </div>
                </div>

                <div class="col-12">
                  <label for="address" class="form-label">Endereço</label>
                  <input type="text" class="form-control" id="address" placeholder="1234 Rua St" required>
                  <div class="invalid-feedback">
                    Endereço é obrigatório.
                  </div>
                </div>

                <div class="col-12">
                  <label for="address2" class="form-label">Número</label>
                  <input type="text" class="form-control" id="address2" placeholder="Ex: 200" required>
                  <div class="invalid-feedback">
                    Número é obrigatório.
                  </div>
                </div>

                <div class="col-12">
                  <label for="address3" class="form-label">Complemento <span class="text-muted">(Opcional)</span></label>
                  <input type="text" class="form-control" id="address3" placeholder="Apartamento ou Referência">
                </div>

                <div class="col-md-5">
                  <label for="country" class="form-label">País</label>
                  <select class="form-select" id="country" required>
                    <option value="">Selecionar...</option>
                    <option>Brasil</option>
                  </select>
                  <div class="invalid-feedback">
                    Selecione um País.
                  </div>
                </div>

                <div class="col-md-4">
                  <label for="state" class="form-label">Estado</label>
                  <select class="form-select" id="state" required>
                    <option value="">Escolher...</option>
                    <option>São Paulo</option>
                  </select>
                  <div class="invalid-feedback">
                    Selecione um Estado.
                  </div>
                </div>

                <div class="col-md-3">
                  <label for="zip" class="form-label">CEP</label>
                  <input type="text" class="form-control" id="zip" placeholder="" required>
                  <div class="invalid-feedback">
                    CEP é obrigatório.
                  </div>
                </div>
              </div>
              </br>

              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="same-address">
                <label class="form-check-label" for="same-address">Receber aviso no email</label>
              </div>

              <hr class="my-4">

              <button class="w-100 btn btn-dark btn-lg" name="btnOk" id="btnOk" type="submit">Confirmar</button>
            </form>
          </div>
        </div>
  </main>

</div>


    <script src="../bootstrap/js/bootstrap.bundle.min.js" type="text/javascript"></script>

      <script src="js/form-validation.js" type="text/javascript"></script>
  </body>
</html>
