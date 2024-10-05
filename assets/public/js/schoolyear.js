$(document).ready(function() {
  $("#school-year-submit").on("click", function() {
    const body = { year: Number.parseInt($(this).attr("data-sy")) };
    console.log("BODY:", body);
    $.post(pathname("/api/post/openschoolyear"), body)
      .done(function({ success, error, sy }) {
        console.log(success, error, sy)
        if (success) {
          Swal.fire({
            title: "School Year Opened",
            text: `School Year ${sy} - ${sy + 1} has been opened successfully`,
            icon: "success",
            confirmButtonText: "Okay",
          }).then(() => {
            window.location.reload();
          });
        } else {
          Swal.fire({
            title: "Error Opening School Year",
            text: error,
            icon: "error",
            confirmButtonText: "Okay",
          });
        }
      })
      .fail(function(e) {
        Swal.fire({
          title: "Error Opening School Year",
          text: e.responseText,
          icon: "error",
          confirmButtonText: "Okay",
        });
        console.log(e);
      });
  });
});