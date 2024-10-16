(() => {
  "use strict";
  const forms = document.querySelectorAll(".needs-validation");

  function showSweetAlert(title, text, icon, timer) {
    let timerInterval;
    Swal.fire({
      title: title,
      text: text,
      icon: icon,
      timer: timer,
      timerProgressBar: true,
      willClose: () => {
        clearInterval(timerInterval);
      },
    });
  }

  function submitLoginForm(formId) {
    $(formId).submit(function (e) {
      e.preventDefault();
      var form = $(this);
      var url = "assets/php/sign-in.php";
      $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(),
        success: function (data) {
          console.log(data);
          var result = JSON.parse(data);
          showSweetAlert(
            result.status.toUpperCase(),
            result.message,
            result.status,
            5000
          );
          
          if (result.status == "success") {
            setTimeout(function () {
              window.location.href = "dashboard.php";
            }, 500);
          }
        },
        error: function (data) {
          var result = JSON.parse(data);
          showSweetAlert(
            result.status.toUpperCase(),
            result.message,
            result.status,
            5000
          );

        },
      });
    });
  }
  document.addEventListener("mouseup", (event) => {
    if (window.getSelection().toString() !== "") {
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
  submitLoginForm("#sign-in-form");
})();
