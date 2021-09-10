// #region form-validation.js */

// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  "use strict";

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll(".needs-validation");

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms).forEach(function (form) {
    form.addEventListener(
      "submit",
      function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }

        form.classList.add("was-validated");
      },
      false
    );
  });
})();
// #endregion form-validation.js */

form = document.getElementById("form");

form.addEventListener(
  "submit",
  function (event) {
    p1 = document.getElementById("senha");
    p2 = document.getElementById("confirmar_senha");

    if (p1.value != p2.value) {
      p2.classList.add("invalido");
      event.preventDefault();
      event.stopPropagation();
    }

    form.classList.add("was-validated");
  },
  false
);
