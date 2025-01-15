  $(document).ready(function () {
    $("#rsvpBtn").on("click", function () {
      $("#rsvpModal").modal("show");
    });

    $("#attending").on("change", function () {
      let attendingvalue = $(this).val();
      if (attendingvalue === "Yes") {
        $("#additionalFields").slideDown();
        $("#mealList").val("");
        $("#songChoice").val("");
        $("#fridayevening").val("");
        $("#allergies").val(""); 
      } else {
        $("#additionalFields").slideUp();
        $("#mealList").val("X");
        $("#songChoice").val("X");
        $("#fridayevening").val("X");
        $("#allergies").val("X");
      }
    });

    $("#attending1").on("change", function () {
      let attendingvalue = $(this).val();
      if (attendingvalue === "No") { 
        $("#songChoiceWrapper1").slideUp();
        $("#mealListWrapper1").slideUp();
        $("#fridayeveningWrapper1").slideUp();
        $("#allergiesWrapper1").slideUp();
        $("#mealList1").val("X");
        $("#songChoice1").val("X");
        $("#fridayevening1").val("X");
        $("#allergies1").val("X");
      }
      else{
        $("#songChoiceWrapper1").slideDown();
        $("#mealListWrapper1").slideDown();
        $("#fridayeveningWrapper1").slideDown();
        $("#allergiesWrapper1").slideDown();
        $("#mealList1").val("");
        $("#songChoice1").val("");
        $("#fridayevening1").val("");
        $("#allergies1").val(""); 
      }
    });

    $("#attending2").on("change", function () {
      let attendingvalue = $(this).val();
      if (attendingvalue === "No") { 
        $("#songChoiceWrapper2").slideUp();
        $("#mealListWrapper2").slideUp();
        $("#fridayeveningWrapper2").slideUp();
        $("#allergiesWrapper2").slideUp();
        $("#mealList2").val("X");
        $("#songChoice2").val("X");
        $("#fridayevening2").val("X");
        $("#allergies2").val("X");
      }
      else{
        $("#songChoiceWrapper2").slideDown();
        $("#mealListWrapper2").slideDown();
        $("#fridayeveningWrapper2").slideDown();
        $("#allergies2").slideDown();
        $("#mealList2").val("");
        $("#songChoice2").val("");
        $("#fridayevening2").val("");
        $("#allergies2").val("");  
      }
    });

    $("#attending3").on("change", function () {
      let attendingvalue = $(this).val();
      if (attendingvalue === "No") { 
        $("#songChoiceWrapper3").slideUp();
        $("#mealListWrapper3").slideUp();
        $("#fridayeveningWrapper3").slideUp();
        $("#allergiesWrapper3").slideUp();
        $("#mealList3").val("X");
        $("#songChoice3").val("X");
        $("#fridayevening3").val("X");
        $("#allergies3").val("X");
      }
      else{
        $("#songChoiceWrapper3").slideDown();
        $("#mealListWrapper3").slideDown();
        $("#fridayeveningWrapper3").slideDown();
        $("#allergies3").slideDown();
        $("#mealList3").val("");
        $("#songChoice3").val("");
        $("#fridayevening3").val("");
        $("#allergies3").val(""); 
      }
    });
  });

  $("#numberList").on("change", function () {
    let selectedValue = parseInt($(this).val()) || 0;
    for (let i = 1; i <= 3; i++) {
      if (i <= selectedValue) {
        $(`#additionalSubmissions${i}`).slideDown();
        $(`#rsvpName${i}`).prop("disabled", false);
        $(`#mealList${i}`).prop("disabled", false);
        $(`#attending${i}`).prop("disabled", false);
        $(`#fridayevening${i}`).prop("disabled", false);
        $(`#rsvpName${i}`).val("");
        $(`#attending${i}`).val("");
        $(`#songChoice${i}`).val("");
        $(`#mealList${i}`).val("");
        $(`#fridayevening${i}`).val("");
        $(`#allergies${i}`).val("");
      } else {
        $(`#additionalSubmissions${i}`).slideUp();
        $(`#rsvpName${i}`).val("X");
        $(`#attending${i}`).val("X");
        $(`#songChoice${i}`).val("X");
        $(`#mealList${i}`).val("X");
        $(`#fridayevening${i}`).val("X");
        $(`#allergies${i}`).val("X");
      }
    }
  });

  $("#rsvpForm").on("submit", function (e) {
    e.preventDefault();
    let attending = $("#attending").val();
    let name = $("#rsvpName").val();
    let email = $("#email").val();
    let song = $("#songChoice").val();
    let meal = $("#mealList").val();
    let additionalguests = $("#numberList").val();
    let fridayevening = $("#fridayevening").val();
    let allergies = $("#allergies").val();
    let attending1 = $("#attending1").val();
    let name1 = $("#rsvpName1").val();
    let song1 = $("#songChoice1").val();
    let meal1 = $("#mealList1").val();
    let fridayevening1 = $("#fridayevening1").val();
    let allergies1 = $("#allergies1").val();
    let attending2 = $("#attending2").val();
    let name2 = $("#rsvpName2").val();
    let song2 = $("#songChoice2").val();
    let meal2 = $("#mealList2").val();
    let fridayevening2 = $("#fridayevening2").val();
    let allergies2 = $("#allergies2").val();
    let attending3 = $("#attending3").val();
    let name3 = $("#rsvpName3").val();
    let song3 = $("#songChoice3").val();
    let meal3 = $("#mealList3").val();
    let fridayevening3 = $("#fridayevening3").val();
    let allergies3 = $("#allergies3").val();
    $.ajax({
      url: "../php/addGuest.php",
      type: "POST",
      data: {
        attending: attending,
        name: name,
        email: email,
        song: song,
        mealList: meal,
        additionalguests: additionalguests,
        fridayevening: fridayevening,
        allergies: allergies,
        attending1: attending1,
        name1: name1,
        song1: song1,
        mealList1: meal1,
        fridayevening1: fridayevening1,
        allergies1: allergies1,
        attending2: attending2,
        name2: name2,
        song2: song2,
        mealList2: meal2,
        fridayevening2: fridayevening2,
        allergies2: allergies2,
        attending3: attending3,
        name3: name3,
        song3: song3,
        mealList3: meal3,
        fridayevening3: fridayevening3,
        allergies3: allergies3,
      },
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          window.location.href = "../pages/thankyou.html";
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
