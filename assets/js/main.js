(() => {
  "use strict";
  const forms = document.querySelectorAll(".needs-validation");

  document.addEventListener('mouseup', (event) => {
    if (window.getSelection().toString() !== '') {
      window.getSelection().removeAllRanges();
    }
  });

  // Loop over them and prevent submission
  Array.from(forms).forEach((form) => {
    form.addEventListener(
      "submit",
      (event) => {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }

        form.classList.add("was-validated");
      },
      false
    );
  });

  // ClientObj.drive();
  // AdminObj.drive();
  setInterval(checkSensor, 2000);
  checkSensor();
})();
