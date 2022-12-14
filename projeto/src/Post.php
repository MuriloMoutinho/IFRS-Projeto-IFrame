<?php

require_once __DIR__."\User.php";
require_once __DIR__."\ActiveRecord.php";

class Post implements ActiveRecord{

    public function __construct(private $foto){
    }
    private int $criador;
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
    public function setCriador(string $criador):void{
        $this->criador = $criador;
    }
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
 
    //FINDPOST ------------------------------------------------

    public static function findPost($id):Post{
        $conexao = new MySQL();
        $sqlPost = "SELECT criador,foto,dataCriacao,descricao FROM post WHERE id = '{$id}'";
        $post = $conexao->consulta($sqlPosts);

        $p = new Post($post['0']['foto']);
        $p->setCriador($post['0']['criador']);
        $p->setData($post['0']['dataCriacao']);
        $p->setDescricao($post['0']['descricao']);
        
        return $p;
    }

    //FINDPROFILE ------------------------------------------------
    public static function findAllPosts():array{
        $conexao = new MySQL();
        $sqlPosts = "SELECT * FROM post ORDER BY dataCriacao desc";
        $postsBanco = $conexao->consulta($sqlPosts);
        
        $postsProfile = array();
        foreach($postsBanco as $post){

            $sqlUser = "SELECT usuario.nome,turma.curso,usuario.foto FROM usuario, turma WHERE usuario.turma = turma.id AND usuario.id = '{$post['criador']}'";
            
            $userBanco = $conexao->consulta($sqlUser);

            $u = new User();
            $u->setNome($userBanco['0']['nome']);
            $u->setTurma($userBanco['0']['curso']);     
            $u->setfoto($userBanco['0']['foto']);

            $p = new Post($post['foto']);
            $p->setCriador($post['criador']);
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

        $sqlPosts = "SELECT post.* FROM usuario, post WHERE nome = '{$nameCriador}' AND post.criador = usuario.id ORDER BY post.dataCriacao desc";

        $postsBanco = $conexao->consulta($sqlPosts);
        
        $postsProfile = array();
        foreach($postsBanco as $post){

            $p = new Post($post['foto']);
            $p->setCriador($post['criador']);
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

        $sqlVerifica = "SELECT 1 as existe
        FROM post
        WHERE 
        post.criador = {$_SESSION['idSession']} AND 
        post.id = {$this->id}";

        $verificadorPermissaoExclusao = $conexao->consulta($sqlVerifica);

        if(empty($verificadorPermissaoExclusao)){
           return false;
        }
        $sql = "DELETE FROM post WHERE post.id = '{$this->id}'";
        unlink("../photos/posts/".$this->foto);
        return $conexao->executa($sql);
    }

    //SALVAR ------------------------------------------------
    public function save():bool{
        $conexao = new MySQL();
        
        $typesImg = array("JPG", "JPEG", "GIF", "PNG", "SVG", "PSD", "WEBP", "RAW", "TIFF", "BMP", "jpg", "gif", "png", "svg", "psd", "webp", "raw", "tiff", "bmp", "jpeg");

        $diretorio = "photos/posts/";
        $nome_foto = $this->foto;
        $info_name = explode(".",$nome_foto);
        $extensao = end($info_name);

        if(!in_array($extensao, $typesImg)){
            return false;
        }
        $this->foto = uniqid().".".$extensao;
        move_uploaded_file($_FILES["newPhoto"]["tmp_name"], $diretorio.$this->foto);

        $sql = "INSERT INTO post (criador,foto,descricao,dataCriacao) VALUES ('{$this->criador}','{$this->foto}','{$this->descricao}',CURRENT_TIMESTAMP())";
        
        
        return $conexao->executa($sql);
    }
}
