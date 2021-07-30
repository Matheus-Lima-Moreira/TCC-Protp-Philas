/// <reference path="../../typings/globals/jquery/index.d.ts" />

url = "http://localhost/TCC/Protp_Philas";

$(function () {
  edtNome = $("#edtNome");
  edtEmail = $("#edtEmail");
  edtUsuario = $("#edtUsuario");
  edtTelefone = $("#edtTelefone");
  edtCPF = $("#edtCPF");
  edtSenha = $("#edtSenha");
  edtConfirmarSenha = $("#edtConfirmarSenha");

  btnUsuario = $("#btnUsuario");
  btnOk = $("#btnOk");

  chkTermos = $("#chkTermos");

  lblTermos = $("#lblTedrmos");

  // Add um usuario ou nao
  btnUsuario.click(function () {
    // edtUsuario.toggle();

    if (edtUsuario.css("display") === "none") {
      // edtUsuario.slideDown("fast");

      edtUsuario.css("display", "block");
      edtUsuario.attr("required", "true");

      edtEmail.removeAttr("required");
    } else {
      // edtUsuario.slideUp("fast");

      // edtUsuario.classList.add("hide-me"); https://codepen.io/anon/pen/RGOqQY

      edtUsuario.css("display", "none");
      edtUsuario.removeAttr("required");

      edtEmail.attr("required", "true");
    }
  });

  // Submitar com REST
  /*
  btnOk.click(function () {
    endpoint = "/users";

    data = {
      _nome: edtNome.val(),
      _telefone: edtTelefone.val(),
      _cpf: edtCPF.val(),
      _login: edtUsuario.val(),
      _senha: edtSenha.val(),
      _email: edtEmail.val(),
      _tipo: "Comum",
    };

    $.ajax({
      url: url + endpoint,
      method: "POST",
      // accepts: "application/json", //
      // contentType: "application/json",
      // dataType: "json", //

      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
      },
      data: JSON.stringify(data),
      // success: function (response, status, jqXHR) {
      //   $("body").append(JSON.stringify(response) + jqXHR.status);
      // },

      // statusCode: {
      //   201: function (response, status, jqXHR) {
      //     $("body").append(JSON.stringify(response) + jqXHR.status);
      //   },
      // },

      complete: function (jqXHR, status) {
        $("body").append(JSON.stringify(jqXHR.responseJSON) + jqXHR.status)
      },
    });
  });
  */
});