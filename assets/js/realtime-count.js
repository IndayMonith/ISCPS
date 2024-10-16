function getCount(){
    let vehicleIn = document.getElementById('vehicleIn');
    let vehicleOut = document.getElementById('vehicleOut');
    let vehicleCurrent = document.getElementById('vehicleCurrent');

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