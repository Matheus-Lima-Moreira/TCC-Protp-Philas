/// <reference path="../../typings/globals/jquery/index.d.ts" />
// TODO: Documentar tudo (variavel funcao...)

var url = "http://localhost/TCC/Protp_Philas";

var slcMotivo;

var edtOutro;
var edtData;
var edtAtendido;
var edtAtendente;

var divParticipantes;

var btnDef;
var btnOk;

$(function () {
  slcMotivo = $("#slcMotivo");

  edtOutro = $("#edtOutro");
  edtData = $("#edtData");
  edtAtendido = $("#edtAtendido");
  edtAtendente = $("#edtAtendente");

  divParticipantes = $("#Participantes");

  btnDef = $("#btnDef");
  btnOk = $("#btnOK");

  // TODO: validar as datas e outros, tem que apagar os campos quando sumir, talvez na hora de submitar
  // Motivo Outro
  slcMotivo.on("change", function () {
    if ($(this).find(":selected").val() === "") { // "" => outro
      edtOutro.show(); // edtOutro.css("display", "block")
      edtData.hide();
    } else {
      edtOutro.hide(); // edtOutro.css("display", "none")
      edtData.show();
      // alert($(this).find(":selected").data("tempoPrevisto")); pegar o tempo previsto lol
    }
  });

  // Def Part
  btnDef.click(function () {
    divParticipantes.toggle();
  });
});