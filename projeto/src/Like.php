<?php

require_once __DIR__."\Post.php";
require_once __DIR__."\ActiveRecord.php";

class Like implements ActiveRecord{
    
    private int $id;
    private int $post;
    private string $usuario;

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
 


    /*  //FINDGIVELIKES ------------------------------------------------
    public static function findLikesGive($idUser):array{
        $conexao = new MySQL();

        $sqlUserLikes = "SELECT usuario FROM post_curtidas WHERE post = '{$idPost}'";
        $nomeUserLikes = $conexao->consulta($sqlUserLikes);
        
        $users = array();
        foreach($nomeUserLikes as $idUser){

            $sqlUser = "SELECT nome FROM usuario WHERE id = '{$idUser}'";
            $nome = $conexao->consulta($sqlUser);

            $u = User::findProfile($nome);
            $users[] = $U;
        }
        return $users;
    }*/

    /*//FINDLIKESPOSTS ------------------------------------------------
    public static function findProfileLikes($idPost):array{
        $conexao = new MySQL();

        $sqlUserLikes = "SELECT usuario FROM post_curtidas WHERE post = '{$idPost}'";
        $nomeUserLikes = $conexao->consulta($sqlUserLikes);
        
        $users = array();
        foreach($nomeUserLikes as $idUser){

            $sqlUser = "SELECT nome FROM usuario WHERE id = '{$idUser}'";
            $nome = $conexao->consulta($sqlUser);

            $u = User::findProfile($nome);
            $users[] = $U;
        }
        return $users;
    }*/
    
    //count ------------------------------------------------
    public static function countLikesProfile($userName):String{
        $conexao = new MySQL();
        
        $sqlCriador = "SELECT id FROM usuario WHERE nome = '{$userName}'";
        $idCriador = $conexao->consulta($sqlCriador);

        $sqlPosts = "SELECT id FROM post WHERE criador = {$idCriador['0']['id']}";
        $postsBanco = $conexao->consulta($sqlPosts);

        $totalLikes = 0;
        foreach($postsBanco as $post){
            $totalLikes += $countLikesPost($post['id']);
        }

        return $countLikes['0']['numeroLikes'];;
    }

    //count ------------------------------------------------
    public static function countLikesPost($idPost):String{
        $conexao = new MySQL();
        
        $sqlLikes = "SELECT COUNT(1) as numeroLikes FROM post_curtida WHERE post = '{$idPost}'";
        $countLikes = $conexao->consulta($sqlLikes);

        return $countLikes['0']['numeroLikes'];;
    }

    //DELETE ------------------------------------------------
    public function delete():bool{
        $conexao = new MySQL();
        $sql = "DELETE FROM post_curtida WHERE post = '{$this->post}' AND usuario = '{$this->usuario}'";
        return $conexao->executa($sql);
    }

    //SALVAR ------------------------------------------------
    public function save():bool{
        $conexao = new MySQL();

        $sqVerifica = "SELECT * FROM post_curtida WHERE post = '{$this->post}' AND usuario = '{$this->usuario}'";
        $verifica = $conexao->consulta($sqVerifica);

        if(empty($verifica)){
            $sqlInserLike = "INSERT INTO post_curtida (post,usuario) VALUES ('{$this->post}','{$this->usuario}')";
            $conexao->executa($sqlInserLike);
            return true;
        }
        return false;
    }
}
