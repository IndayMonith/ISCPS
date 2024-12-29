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

(() => {
  "use strict";
  const forms = document.querySelectorAll(".needs-validation");

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

  $("#dataTable").DataTable({
    ajax: {
      url: "assets/php/get-data.php",
      type: "GET",
    },
    processing: true,
    serverSide: true,
    columns: [
      { title: "ID", data: 0 },
      { title: "SLOT ID", data: 1 },
      { title: "TIME IN", data: 2 },
      { title: "TIME OUT", data: 3 },
      { title: "DURATION", data: 4 },
      { title: "CREATED AT", data: 5 },
    ],
    search: {
      return: true,
    },
    layout: {
      topStart: {
        buttons: [
          {
            extend: "print",
            text: "Print Table",
            title: '<div class="print-title">ICSPS - IoT Smart Parking System</div>', // Centered title
            className: "btn btn-primary",
            exportOptions: {
              columns: ":visible", // Only export visible columns
            },
          },
          {
            extend: "excelHtml5",
            text: "Export to Excel",
            title: "ICSPS - IoT Smart Parking System", // Title for the exported file
            className: "btn btn-success",
            exportOptions: {
              columns: ":visible", // Only export visible columns
            },
          },
        ],
      },
    },
    responsive: {
      details: {
        display: DataTable.Responsive.display.modal({
          header: function (row) {
            var data = row.data();
            return "Details for " + data[0] + " " + data[1];
          },
        }),
        renderer: DataTable.Responsive.renderer.tableAll({
          tableClass: "table",
        }),
      },
    },
  });


  $("#dataTable-tali").DataTable({
    ajax: {
      url: "assets/php/get-tali.php",
      type: "GET",
    },
    processing: true,
    serverSide: true,
    columns: [
      { title: "TALI DATE", data: 0 },
      { title: "CAR PARKED COUNT", data: 1 }
    ],
    search: {
      return: true,
    },
    layout: {
      topStart: {
        buttons: [
          {
            extend: "print",
            text: "Print Table",
            title: '<div class="print-title">ICSPS - IoT Smart Parking System</div>', // Centered title
            className: "btn btn-primary",
            exportOptions: {
              columns: ":visible", // Only export visible columns
            },
          },
          {
            extend: "excelHtml5",
            text: "Export to Excel",
            title: "ICSPS - IoT Smart Parking System", // Title for the exported file
            className: "btn btn-success",
            exportOptions: {
              columns: ":visible", // Only export visible columns
            },
          },
        ],
      },
    },
    responsive: {
      details: {
        display: DataTable.Responsive.display.modal({
          header: function (row) {
            var data = row.data();
            return "Details for " + data[0] + " " + data[1];
          },
        }),
        renderer: DataTable.Responsive.renderer.tableAll({
          tableClass: "table",
        }),
      },
    },
  });

  $("#layout-link").attr("href", "assets/img/layout/0.png");
  $("#layout-image").attr("src", "assets/img/layout/0.png");
  // ClientObj.drive();
  // AdminObj.drive();
  submitLoginForm("#sign-in-form");
  setInterval(checkSensor, 500);
  setInterval(getCount, 1000);
  setInterval(getSlotsCount, 1000);
  getChartData();
  getCount();
  ProtectPage();

})();
