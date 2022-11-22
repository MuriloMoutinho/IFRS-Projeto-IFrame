function likePost(idPost) {
    $.post("config/likePost.php", {idPost:idPost});
}