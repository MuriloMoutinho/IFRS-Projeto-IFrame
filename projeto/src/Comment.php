<?php

require_once __DIR__."\Post.php";
require_once __DIR__."\ActiveRecord.php";

class Comment implements ActiveRecord{
    
    private int $id;
    private int $post;
    private string $usuario;
    private string $conteudo;
    private string $dataCriacao;


    //ID ------------------------------------------------
    public function setId(int $id):void{
        $this->id = $id;
    }
    public function getId():int{
        return $this->id;
    } 

    //post ------------------------------------------------
    public function setPost(int $post):void{
        $this->post = $post;
    }
    public function getPost():int{
        return $this->post;
    }

    //usuario ------------------------------------------------
    public function setUsuario(string $usuario):void{
        $this->usuario = $usuario;
    }
    public function getUsuario():string{
        return $this->usuario;
    }
     //usuario ------------------------------------------------
     public function setConteudo(string $conteudo):void{
        $this->conteudo = $conteudo;
    }
    public function getConteudo():string{
        return $this->conteudo;
    }

    //usuario ------------------------------------------------
    public function setData(string $dataCricao):void{
        $this->dataCricao = $dataCricao;
    }
    public function getData():string{
        return $this->dataCricao;
    }

    //FINDLIKESPOSTS ------------------------------------------------
    public static function findPostComment($idPost):array{
        $conexao = new MySQL();

        $sqlComment = "SELECT * FROM post_comentario WHERE post = '{$idPost}'";
        $comments = $conexao->consulta($sqlComment);
        
        $commentsProfile = array();
        foreach($comments as $comment){
            $sqlUser = "SELECT usuario.nome,turma.curso,usuario.foto FROM usuario, turma WHERE usuario.turma = turma.id AND usuario.id = '{$comment['usuario']}'";
            $userBanco = $conexao->consulta($sqlUser);

            $u = new User();
            $u->setNome($userBanco['0']['nome']);
            $u->setTurma($userBanco['0']['curso']);     
            $u->setfoto($userBanco['0']['foto']);

            $c = new Comment();
            $c->setUsuario($comment['usuario']);
            $c->setConteudo($comment['conteudo']);
            $c->setData(strval($comment['dataCriacao']));

            $commentsProfile[] = array($u,$c);
        }
        return $commentsProfile;
    }

    //count ------------------------------------------------
    public static function countCommentPost($idPost):String{
        $conexao = new MySQL();
        
        $sqlComment = "SELECT COUNT(1) as numeroComments FROM post_comentario WHERE post = '{$idPost}'";
        $countComment = $conexao->consulta($sqlComment);

        return $countComment['0']['numeroComments'];;
    }

    //DELETE ------------------------------------------------
    public function delete():bool{
        $conexao = new MySQL();
        $sql = "DELETE FROM post_comentario WHERE id = '{$this->id}'";
        return $conexao->executa($sql);
    }

    //SALVAR ------------------------------------------------
    public function save():bool{
        $conexao = new MySQL();
        
            $sqlInserComment = "INSERT INTO post_comentario (post,usuario,dataCriacao,conteudo) VALUES ('{$this->post}','{$this->usuario}',CURRENT_TIMESTAMP(),'{$this->conteudo}')";

            return  $conexao->executa($sqlInserComment);
        
    }
}
