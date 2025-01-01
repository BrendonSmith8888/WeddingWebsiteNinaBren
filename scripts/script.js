$("#rsvpBtn").on("click", function () {
      $("#rsvpModal").modal("show");
  });

  $("#rsvpForm").on("submit", function (e) {
    e.preventDefault();
    let name = $("#rsvpName").val();
    let email = $("#email").val();
    let song = $("#songChoice").val();
    let meal = $("#mealList").val();
    $.ajax({
      url: "../php/addGuest.php",
      type: "POST",
      data: {
        name: name,
        email: email,
        song: song,
        mealList: meal,
      },
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          let guest = response.data;
          console.log(guest);
        } else {
          console.log(response);
          console.error(
            "No data found or an error occurred:",
            response.error || "Unknown error"
          );
        }
        $("#rsvpModal").modal("hide");
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("AJAX error:", textStatus, errorThrown);
        console.log("Response text:", jqXHR.responseText);
      },
    });
  });