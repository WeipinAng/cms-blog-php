$(document).ready(function () {
  $("#summernote").summernote({
    height: 300, // set editor height
    focus: false, // set focus to editable area after initializing summernote
  });
});

// make sure jQuery is working
$(document).ready(function () {
  // checkboxes in view_all_posts.php
  $("#selectAllBoxes").click(function (event) {
    if (this.checked) {
      // iterate through the object using each function
      $(".checkBoxes").each(function () {
        this.checked = true;
      });
    } else {
      $(".checkBoxes").each(function () {
        this.checked = false;
      });
    }
  });

  var div_box = "<div id='cover-spin'></div>";
  $("body").prepend(div_box);
  $("#cover-spin")
    .show(0)
    .delay(700)
    .fadeOut(600, function () {
      $(this).remove();
    });

  // sending AJAX request (Instant Users Online Count without Refreshing)
  function loadUsersOnline() {
    $.get("functions.php?onlineusers=result", function (data) {
      $(".usersonline").text(data);
    });
  }

  // Use JS function called setInterval() to fetch our database constantly
  setInterval(function () {
    loadUsersOnline();
  }, 500); // 500 milliseconds = 0.5 seconds
});
