var commentId = "0";

$("body").on("click", "a.like", function(event) {
  event.preventDefault;
  commentId = event.target.parentNode.dataset["commentid"];
  var islike = event.target.previousElementSibling == null;
  $.ajax({
    method: "POST",
    url: urllike,
    data: { islike: islike, commentId: commentId, _token: token }
  }).done(function() {
    console.log(event.target.classList.contains("btn-default"));
    if (islike) {
      if (event.target.classList.contains("btn-default")) {
        event.target.classList.remove("btn-default");
        event.target.classList.add("btn-primary");
      } else {
        event.target.classList.remove("btn-primary");
        event.target.classList.add("btn-default");
      }
      event.target.nextElementSibling.classList.remove("btn-primary");
      event.target.nextElementSibling.classList.add("btn-default");
    } else {
      if (event.target.classList.contains("btn-default")) {
        event.target.classList.remove("btn-default");
        event.target.classList.add("btn-primary");
      } else {
        event.target.classList.remove("btn-primary");
        event.target.classList.add("btn-default");
      }
      event.target.previousElementSibling.classList.remove("btn-primary");
      event.target.previousElementSibling.classList.add("btn-default");
    }
  });
});
