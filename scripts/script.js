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
      url: "php/addGuest.php",
      type: "POST",
      data: {
        name: name,
        email: email,
        songChoice: song,
        meal: meal,
      },
      dataType: "json",
      success: function (response) {
        if (response.status === "success" && response.data) {
          let person = response.data;
          $("#personnelTableBody").append(`
              <tr>
                <td class="align-middle text-nowrap">${guest.name}</td>
                <td class="align-middle text-nowrap d-none d-md-table-cell">${guest.email}</td>
                <td class="align-middle text-nowrap d-none d-md-table-cell">${guest.song}</td>
                <td class="align-middle text-nowrap d-none d-md-table-cell">${guest.meal}</td>
              </tr>
            `);
        } else {
          console.log(response);
          console.error(
            "No data found or an error occurred:",
            response.error || "Unknown error"
          );
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("AJAX error:", textStatus, errorThrown);
        console.log("Response text:", jqXHR.responseText);
      },
    });
  });