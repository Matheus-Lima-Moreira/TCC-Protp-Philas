jQuery.datetimepicker.setLocale('pt-BR');
jQuery.datetimepicker.setDateFormatter('moment');

// TODO: add terpo comercial

function setMinTime(cd, $i) {
  let date = moment(cd).format('DD/MM/YYYY');
  let today = moment().format('DD/MM/YYYY');

  $i.datetimepicker({ minTime: date == today ? 0 : false });
}

$('#data_marcada').datetimepicker({
  validateOnBlur: false,
  format: 'DD/MM/YYYY HH:mm',
  minDate: 0,
  minTime: 0,
  maxTime: false,
  step: 5,
  onChangeDateTime: setMinTime,
});

$('#toggle').on('click', function () {
  $('#data_marcada').datetimepicker('toggle');
});
