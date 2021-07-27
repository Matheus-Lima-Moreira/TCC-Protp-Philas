/// <reference path="../../typings/globals/jquery/index.d.ts" />

url = "http://localhost/TCC/Protp_Philas";

$(function () {
  slcMotivo = $("#slcMotivo");

  edtOutro = $("#edtOutro");
  edtData = $("#edtData");
  edtAtendido = $("#edtAtendido");
  edtAtendente = $("#edtAtendente");

  btnDef = $("#btnDef");
  btnOk = $("#btnOK");

  // Def Part
  btnDef.click(function () {
    edtAtendido.toggle();
    edtAtendente.toggle();
  });
});