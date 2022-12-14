function likePost(idPost) {
    $.post("config/likePost.php", {idPost:idPost});
}

function toggleElements(e){

    e.children[0].classList.toggle("like-ativo");

    if(e.children[0].classList.contains("like-ativo")){
        e.innerHTML = "<img src='assets/icos/like_ico3.png' class='like like-ativo' ' id='img-like' alt='Like'>"
        e.parentNode.children[1].children[0].innerHTML ++;
    }else{
        e.innerHTML = "<img src='assets/icos/like_ico1.png' class='like' ' id='img-like' alt='Like'>"
        e.parentNode.children[1].children[0].innerHTML --;
    }

}