function likePost(idPost) {
    $.post("config/likePost.php", {idPost:idPost});
}

function toggleElements(e){

    e.children[0].classList.toggle("like-ativo");
    if(e.children[0].classList.contains("like-ativo")){
        e.parentNode.children[1].children[0].innerHTML ++;
    }else{
        e.parentNode.children[1].children[0].innerHTML --;
    }

}