<?php

require_once 'ActiveRecord.php';
require_once 'MySQL.php';
require_once 'Post.php';

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
 


    //FINDPROFILE ------------------------------------------------
    public static function findAllPosts():array{
        $conexao = new MySQL();
        $sqlPosts = "SELECT * FROM post ORDER BY dataCriacao desc";
        $postsBanco = $conexao->consulta($sqlPosts);
        
        $postsProfile = array();
        foreach($postsBanco as $post){
            $sqlUser = "SELECT nome,turma,foto FROM usuario WHERE id = '{$post['criador']}' ";
            $userBanco = $conexao->consulta($sqlUser);

            $sqlClass = "SELECT curso FROM turma WHERE id = {$userBanco['0']['turma']}";
            $turmaUsuario = $conexao->consulta($sqlClass);

            $u = new User();
            $u->setNome($userBanco['0']['nome']);
            $u->setTurma($turmaUsuario['0']['curso']);     
            $u->setfoto($userBanco['0']['foto']);

            $p = new Post($post['criador'],$post['foto']);
            $p->setId($post['id']);
            $p->setDescricao($post['descricao']);
            $p->setData(strval($post['dataCriacao']));

            $postsProfile[] = array($u,$p);
        }
        return $postsProfile;
    }

    //FIND ----------------xxxx--------------------------------
    public static function findProfilePost($nameCriador):array{
        $conexao = new MySQL();
        
        $sqlCriador = "SELECT id FROM usuario WHERE nome = '{$nameCriador}'";
        $idCriador = $conexao->consulta($sqlCriador);

        $sqlPosts = "SELECT * FROM post WHERE criador = {$idCriador['0']['id']} ORDER BY dataCriacao desc";
        $postsBanco = $conexao->consulta($sqlPosts);
        
        $postsProfile = array();
        foreach($postsBanco as $post){

            $p = new Post($post['criador'],$post['foto']);
            $p->setId($post['id']);
            $p->setDescricao($post['descricao']);

            $p->setData(strval($post['dataCriacao']));

            $postsProfile[] = $p;
        }
        return $postsProfile;
    }
    


    //DELETE ------------------------------------------------
    public function delete():bool{
        $conexao = new MySQL();
        $sql = "DELETE FROM post_curtida WHERE id = {$this->id}";
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
