<?php

require_once 'ActiveRecord.php';
require_once 'MySQL.php';
require_once 'User.php';

class Post implements ActiveRecord{

    public function __construct(private int $criador, private $foto){
    }
    private string $data;
    private int $id;
    private string $descricao;

    //ID ------------------------------------------------
    public function setId(int $id):void{
        $this->id = $id;
    }
    public function getId():int{
        return $this->id;
    }

    //data ------------------------------------------------
    public function setData(string $data):void{
        $this->data = $data;
    }
    public function getData():string{
        return $this->data;
    }
    //criador ------------------------------------------------
    public function getCriador():string{
        return $this->criador;
    }
    //foto ------------------------------------------------
    public function getFoto():string{
        return $this->foto;
    }
    //descricao ------------------------------------------------
    public function setDescricao($descricao):void{
        $this->descricao = $descricao;
    }
    public function getDescricao():string{
        return $this->descricao;
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
        unlink("../photos/posts/".$this->foto);
        $sql = "DELETE FROM post WHERE id = {$this->id}";
        return $conexao->executa($sql);
    }

    //SALVAR ------------------------------------------------
    public function save():bool{
        $conexao = new MySQL();
        
        $diretorio = "photos/posts/";
        $nome_foto = $this->foto;
        $info_name = explode(".",$nome_foto);
        $extensao = end($info_name);
        $this->foto = uniqid().".".$extensao;
        move_uploaded_file($_FILES["newPhoto"]["tmp_name"], $diretorio.$this->foto);

        $sql = "INSERT INTO post (criador,usuario,foto,descricao,dataCriacao) VALUES ('{$this->criador}','{$this->criador}','{$this->foto}','{$this->descricao}',CURRENT_TIMESTAMP())";
        

        return $conexao->executa($sql);
    }
}
