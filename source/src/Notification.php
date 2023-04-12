<?php

require_once __DIR__ . "/MySQL.php";
require_once __DIR__ . "/User.php";
require_once __DIR__ . "/Comment.php";
require_once __DIR__ . "/Post.php";

class Notification
{

    private int $id;
    private int $post;
    private int $comentario;
    private int $usuario;

    //ID ------------------------------------------------
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getId(): int
    {
        return $this->id;
    }

    //post ------------------------------------------------
    public function setPost(int $post): void
    {
        $this->post = $post;
    }
    public function getPost(): int
    {
        return $this->post;
    }

    //usuario ------------------------------------------------
    public function setUsuario(int $usuario): void
    {
        $this->usuario = $usuario;
    }
    public function getUsuario(): int
    {
        return $this->usuario;
    }

    //comentario ------------------------------------------------
    public function setComentario(int $comentario): void
    {
        $this->comentario = $comentario;
    }
    public function getComentario(): int
    {
        return $this->comentario;
    }

    //FINDNOTIFICATIONS ------------------------------------------------
    public static function findNotification($idUser): array
    {
        $conexao = new MySQL();

        $sqlNotification =
        "SELECT post.foto as post, post.id as postId, post_comentario.conteudo, notificacao.id, post_comentario.dataCriacao, usuario.nome, usuario.foto
        FROM notificacao
        JOIN post ON post.id = notificacao.post
        JOIN post_comentario ON post_comentario.id = notificacao.comentario
        JOIN usuario ON usuario.id = post_comentario.usuario
        WHERE notificacao.usuario = {$idUser}";

        $userNotification = $conexao->consulta($sqlNotification);
        
        $notifications = array();
        foreach ($userNotification as $notification) {

            $c = new Comment();
            $c->setConteudo($notification['conteudo']);
            $c->setData($notification['dataCriacao']);
            
            $u = new User();
            $u->setFoto($notification['foto']);
            $u->setNome($notification['nome']);

            $p = new Post($notification['post']);
            $p->setId($notification['postId']);

            $n = new Notification();
            $n->setId($notification['id']);

            $notifications[] = array($u, $p, $c, $n);
        }
        
        return $notifications;
    }

    //DELETE ------------------------------------------------
    public function delete(): bool
    {
        $conexao = new MySQL();
        $sql = "DELETE FROM notificacao WHERE id = '{$this->id}' AND usuario = '{$this->usuario}'";
        return $conexao->executa($sql);
    }
}
