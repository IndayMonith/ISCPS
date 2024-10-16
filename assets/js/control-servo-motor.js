$(document).ready(function() {
    // Handler for the Open Entrance button
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

    $('#openEntrance').on('click', function(event) {
        event.preventDefault(); // Prevent the default anchor behavior

        $.ajax({
            type: "GET",
            url: "http://10.0.0.1/open/entrance",
            success: function(data) {
                showSweetAlert(
                    'Success',
                    'Opening Entrance',
                    'success',
                    5000
                );
            },
            error: function(data) {
                console.error("Error fetching data for entrance");
            },
        });
    });

    // Handler for the Open Exit button
    $('#openExit').on('click', function(event) {
        event.preventDefault(); // Prevent the default anchor behavior

        $.ajax({
            type: "GET",
            url: "http://10.0.0.1/open/exit",
            success: function(data) {
                showSweetAlert(
                    'Success',
                    'Opening Exit',
                    'success',
                    5000
                );
            },
            error: function(data) {
                console.error("Error fetching data for exit");
            },
        });
    });
});
