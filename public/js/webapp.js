var commentId = "0";

$("body").on("click", "a.like", function(event) {
  event.preventDefault;
  commentId = event.target.parentNode.dataset["commentid"];
  var islike = event.target.previousElementSibling == null;
  var num_likes = parseInt(event.target.innerText);
  $.ajax({
    method: "POST",
    url: urllike,
    data: { islike: islike, commentId: commentId, _token: token }
  }).done(function() {
    if (islike) {
      if (event.target.classList.contains("btn-default")) {
        event.target.classList.remove("btn-default");
        event.target.classList.add("btn-primary");
        event.target.firstChild.nextSibling.innerText =
          parseInt(event.target.innerText) + 1;
      } else {
        event.target.classList.remove("btn-primary");
        event.target.classList.add("btn-default");
        event.target.firstChild.nextSibling.innerText =
          parseInt(event.target.innerText) - 1;
      }
      event.target.nextElementSibling.classList.remove("btn-primary");
      event.target.nextElementSibling.classList.add("btn-default");
      if (event.target.nextElementSibling.innerText != "0") {
        event.target.nextElementSibling.firstChild.nextSibling.innerText =
          parseInt(event.target.nextElementSibling.innerText) - 1;
      }
    } else {
      if (event.target.classList.contains("btn-default")) {
        event.target.classList.remove("btn-default");
        event.target.classList.add("btn-primary");
        event.target.firstChild.nextSibling.innerText =
          parseInt(event.target.innerText) + 1;
      } else {
        event.target.classList.remove("btn-primary");
        event.target.classList.add("btn-default");
        event.target.firstChild.nextSibling.innerText =
          parseInt(event.target.innerText) - 1;
      }
      event.target.previousElementSibling.classList.remove("btn-primary");
      event.target.previousElementSibling.classList.add("btn-default");
      if (event.target.previousElementSibling.innerText != "0") {
        event.target.previousElementSibling.firstChild.nextSibling.innerText =
          parseInt(event.target.previousElementSibling.innerText) - 1;
      }
    }
  });
});
