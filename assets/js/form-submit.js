
function submitLoginForm(formId) {
  $(formId).submit(function (e) {
    e.preventDefault();
    var form = $(this);
    var url = "assets/php/auth/sign-in.php";
    $.ajax({
      type: "POST",
      url: url,
      data: form.serialize(),
      success: function (data) {
        console.log(data);
        var result = JSON.parse(data);
        if (result.status == "success") {
          setTimeout(function () {
            window.location.href = "assets/php/auth/userAuth.php";
          }, 500);
        }
      },
      error: function (data) {
        var result = JSON.parse(data);
      },
    });
  });
}
