
// modal acilib baglanmasi olan hisse
$(document).ready(function () {
  $(".post-comment").on("click", function () {
    $("#postModal").modal("show");
  });
  $(".close").on("click", function () {
    $("#postModal").modal("hide");
  });
});

// modal postdan melumatlari alir
document.addEventListener("DOMContentLoaded", function () {
  const comment_btn = document.querySelectorAll(".post-comment");
  let modal = document.querySelector("#postModal");

comment_btn.forEach(function(button){
  button.addEventListener("click", function() {
    const id = button.getAttribute("data-id");
    const userID = button.getAttribute("data-user-id");
    const setUsername = button.getAttribute("data-setName");
    const setUserphoto = button.getAttribute("data-setPhoto");
    const user_name = button.dataset.user_name;
    const user_img = button.dataset.user_img;
    const post_title = button.dataset.post_title;
    const post_text = button.dataset.post_text;
    const post_img = button.dataset.post_img;
    


    const user_name_modal = document.querySelector(".modal-title.username");
    const user_img_modal = document.querySelector("#modalProfilePicture");
    const post_title_modal = document.querySelector(".modal-body .modal-title");
    const post_text_modal = document.querySelector(".modal-body #postModalText");
    const post_img_modal = document.querySelector("#modalPostImage");

    user_name_modal.textContent = user_name;
    user_img_modal.src = user_img;
    post_title_modal.textContent = post_title;
    post_text_modal.textContent = post_text;


    if (post_img.length > 27) {
      post_img_modal.setAttribute("style", "display:block");
      post_img_modal.src = post_img;
    } else {
      post_img_modal.setAttribute("style", "display:none");
    }

}) 


})
      });


// comment olan hisse 
const commentdivs = document.createElement("div");
commentdivs.classList.add("comentdiv");  
$(".post-comment").click(function () {
  const id = $(this).attr("data-id");
  $(".comentdiv").empty();
  $("[name='comment_post']").attr("post_id", id);
  $.post("./pages/partials/comment.php", { post_id: id }, function (res) {
    res.map((comment) => {

      let mediaBlock = document.createElement("div");
      mediaBlock.className = "media-block";
      
      let contentHTML = '<a class="media-left" href="#"><img class="img-circle img-sm" alt="Profile Picture" src="' + comment.user.photo + '"></a>' +
      '<div class="media-body">' +
      '<div class="mar-btm">' +
      '<h6  class=" text-semibold media-heading box-inline">' + comment.user.name + '</h6>' +
      '</div>' +
      '<p>' + comment.comment + '</p>' +
      '<div class="pad-ver">' +
      '<div class="btn-group">' +
      '<a class="btn btn-sm btn-default btn-hover-success" href="#"><i class="fa fa-thumbs-up"></i></a>' +
      '<a class="btn btn-sm btn-default btn-hover-danger" href="#"><i class="fa fa-thumbs-down"></i></a>' +
      '</div>' +
      '<a class="btn btn-sm btn-default btn-hover-primary" href="#">Comment</a>' +
      '</div>' +
      '<hr>';
      
      mediaBlock.innerHTML = contentHTML;
      commentdivs.append(mediaBlock);
      $(".panel-body").append(commentdivs);
    });
  });
});

$("[name='comment_post']").click(function () {
  const id = $(this).attr("post_id");
  const photo = $(".post-comment").attr("data-setPhoto");
  const name = $(".post-comment").attr("data-setName");
  const comment = $("[name='post_comment_text']").val();
  const data = {
    userName:name,
    userPhoto:photo,
    post_id: id,
    comment: comment,
  };
  $.post("./AJAX/comment.php", data, function (res) {
    if (res.success) {
      $("[name='post_comment_text']").val("");
       
      console.log(data);

      let mediaBlock = document.createElement("div");
      mediaBlock.className = "media-block";

      let contentHTML = '<a class="media-left" href="#"><img class="img-circle img-sm" alt="Profile Picture" src="' + data.userPhoto + '"></a>' +
        '<div class="media-body">' +
        '<div class="mar-btm">' +
        '<h6  class=" text-semibold media-heading box-inline">' + data.userName + '</h6>' +
        '</div>' +
        '<p>' + data.comment + '</p>' +
        '<div class="pad-ver">' +
        '<div class="btn-group">' +
        '<a class="btn btn-sm btn-default btn-hover-success" href="#"><i class="fa fa-thumbs-up"></i></a>' +
        '<a class="btn btn-sm btn-default btn-hover-danger" href="#"><i class="fa fa-thumbs-down"></i></a>' +
        '</div>' +
        '<a class="btn btn-sm btn-default btn-hover-primary" href="#">Comment</a>' +
        '</div>' +
        '<hr>';

      mediaBlock.innerHTML = contentHTML;

      $(".comentdiv").prepend(mediaBlock);

    }
  });
});

// like olan hisse 
const heartIcons = document.querySelectorAll("#heartIcon");

heartIcons.forEach(function (heartIcon) {
  const heart_i = heartIcon.querySelector("i");

  heartIcon.addEventListener("click", function () {
    if (heart_i.classList.contains("bi-heart-fill")) {
      heart_i.classList.remove("bi-heart-fill");
      heart_i.classList.add("bi-heart");
    } else {
      heart_i.classList.remove("bi-heart");
      heart_i.classList.add("bi-heart-fill");
    }
  });
});

document.querySelectorAll(".post-heart").forEach(function (heartButton) {
  heartButton.addEventListener("click", (a) => {
    let postId = heartButton.getAttribute("data-post-id");
    let likedId = heartButton.getAttribute("data-liked-id");
    let liked = heartButton.getAttribute("data-liked") === "true";
    console.log(postId);

    fetch("./AJAX/like.php", {
      method: "POST",
      body: new URLSearchParams({
        post_id: postId,
        liked: liked,
        likedId: likedId,
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          let heartIcon = heartButton.querySelector("i");
          let likeCount = heartButton.querySelector("span");
          if (liked) {
            heartIcon.classList.remove("bi-heart-fill");
            likeCount.textContent = +likeCount.textContent - 1;
          } else {
            heartIcon.classList.add("bi-heart-fill");
            likeCount.textContent = +likeCount.textContent + 1;
          }
          heartButton.setAttribute("data-liked", !liked);
        }
      });
  });
});
