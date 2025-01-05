// $("#rsvpBtn").on("click", function () {
//       $("#rsvpModal").modal("show");
//   });

//   $("#rsvpForm").on("submit", function (e) {
//     e.preventDefault();
//     let name = $("#rsvpName").val();
//     let email = $("#email").val();
//     let song = $("#songChoice").val();
//     let meal = $("#mealList").val();
//     $.ajax({
//       url: "../php/addGuest.php",
//       type: "POST",
//       data: {
//         name: name,
//         email: email,
//         song: song,
//         mealList: meal,
//       },
//       dataType: "json",
//       success: function (response) {
//         if (response.status === "success") {
//           let guest = response.data;
//           console.log(guest);
//         } else {
//           console.log(response);
//           console.error(
//             "No data found or an error occurred:",
//             response.error || "Unknown error"
//           );
//         }
//         $("#rsvpModal").modal("hide");
//       },
//       error: function (jqXHR, textStatus, errorThrown) {
//         console.error("AJAX error:", textStatus, errorThrown);
//         console.log("Response text:", jqXHR.responseText);
//       },
//     });
//   });

$(document).ready(function () {
  $("#rsvpBtn").on("click", function () {
    $("#rsvpModal").modal("show");
  });

  $("input[name='attending']").on("change", function () {
    if ($("#attendingYes").is(":checked")) {
      $("#additionalFields").slideDown();
    } else {
      $("#additionalFields").slideUp();
    }
  });
});

$("#numberList").on("change", function () {
  let selectedValue = parseInt($(this).val()) || 0;
  for (let i = 1; i <= 3; i++) {
    if (i <= selectedValue) {
      $(`#additionalSubmissions${i}`).slideDown();
    } else {
      $(`#additionalSubmissions${i}`).slideUp();
    }
  }
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
        console.log("Guest added:", response.data);
      } else {
        console.error("Error:", response.message);
      }
      $("#rsvpModal").modal("hide");
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.error("AJAX error:", textStatus, errorThrown);
      console.log("Response text:", jqXHR.responseText);
    },
  });
});
