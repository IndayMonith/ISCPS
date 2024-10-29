var vehicleChart;

function getCount() {
  let vehicleIn = document.getElementById("vehicleIn");
  let vehicleOut = document.getElementById("vehicleOut");
  let vehicleCurrent = document.getElementById("vehicleCurrent");

  $.ajax({
    type: "POST",
    url: "assets/php/get-vehicle-in.php",
    dataType: "json",
    success: function (data) {
      vehicleIn.innerHTML = data.total_records;
    },
    error: function (data) {
      console.error("Error fetching data for slot 2");
    },
  });

  $.ajax({
    type: "POST",
    url: "assets/php/get-vehicle-out.php",
    dataType: "json",
    success: function (data) {
      vehicleOut.innerHTML = data.total_records;
    },
    error: function (data) {
      console.error("Error fetching data for slot 2");
    },
  });

  $.ajax({
    type: "POST",
    url: "assets/php/get-vehicle-current.php",
    dataType: "json",
    success: function (data) {
      vehicleCurrent.innerHTML = data.total_records;
    },
    error: function (data) {
      console.error("Error fetching data for slot 2");
    },
  });
}

function getChartData() {
  $.ajax({
    type: "POST",
    url: "assets/php/get-piechart.php",
    dataType: "json",
    success: function (data) {
      if (data.status === "success") {
        // Get the count for vehicles in and out
        var vehiclesIn = data.total_in;
        var vehiclesOut = data.total_out;

        // Check if a chart instance already exists, destroy it before creating a new one
        if (vehicleChart) {
          vehicleChart.destroy();
        }

        // Get the canvas context
        var ctx = document.getElementById("chartCanvas").getContext("2d");

        // Create the new doughnut chart
        vehicleChart = new Chart(ctx, {
          type: "doughnut",
          data: {
            labels: ["VEHICLE IN", "VEHICLE OUT"],
            datasets: [
              {
                data: [vehiclesIn, vehiclesOut],
                backgroundColor: ["#4e73df", "#1cc88a"],
                borderColor: ["#ffffff", "#ffffff"],
                borderWidth: 1,
              },
            ],
          },
          options: {
            maintainAspectRatio: false,
            legend: {
              display: false,
            },
            title: {
              display: false,
            },
          },
        });
      } else {
        console.error("Error: " + data.message);
      }
    },
    error: function () {
      console.error("Error fetching data for the chart");
    },
  });
}
