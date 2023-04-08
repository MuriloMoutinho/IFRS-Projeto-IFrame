function likePost(idPost) {
  $.post("config/likePost.php", { idPost: idPost });
}

function confirmDeleteUser() {
  const blur = document.getElementById("blurDeleteUser");
  const modal = document.getElementById("modalDeleteUser");

  blur.classList.remove("hide");
  modal.classList.remove("hide");

  const cancel = document.getElementById("cancelDeleteUser");
  cancel.addEventListener("click", function () {
    blur.classList.add("hide");
    modal.classList.add("hide");
  });
}

function confirmDeletePost(idPost, foto) {
  const blur = document.getElementById("blurDeletePost");
  const modal = document.getElementById("modalDeletePost");

  blur.classList.remove("hide");
  modal.classList.remove("hide");

  const confirm = document.getElementById("confirmDeletePost");
  confirm.addEventListener("click", function () {
    confirm.setAttribute(
      "href",
      `config/deletePost.php?idPost=${idPost}&foto=${foto}`
    );
  });

  const cancel = document.getElementById("cancelDeletePost");
  cancel.addEventListener("click", function () {
    blur.classList.add("hide");
    modal.classList.add("hide");
  });
}

function toggleElements(e) {
  e.children[0].classList.toggle("like-ativo");

  if (e.children[0].classList.contains("like-ativo")) {
    e.innerHTML =
      "<img src='assets/icos/like_ico3.png' class='like like-ativo' ' id='img-like' alt='Like'>";
    e.parentNode.children[1].children[0].innerHTML++;
  } else {
    e.innerHTML =
      "<img src='assets/icos/like_ico1.png' class='like' ' id='img-like' alt='Like'>";
    e.parentNode.children[1].children[0].innerHTML--;
  }
}
