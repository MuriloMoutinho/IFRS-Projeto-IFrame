<?php

require 'ActiveRecord.php';
require 'MySQL.php';

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
    public static function findUser($nome):array{

        $userSearch = "%".trim($nome)."%";

        $conexao = new MySQL();
        $sqlUser = "SELECT nome,foto,turma FROM usuario WHERE nome like '{$userSearch}'";
        $usuariosBanco = $conexao->consulta($sqlUser);
        
        $usuarios = array();
        foreach($usuariosBanco as $usuario){

            $sqlClass = "SELECT curso FROM turma WHERE id = {$usuario['turma']}";
            $turmaUsuario = $conexao->consulta($sqlClass);

            $u = new User();
            $u->setNome($usuario['nome']);
            $u->setTurma($turmaUsuario['0']['curso']); //retorna o nome da turma        
            $u->setfoto($usuario['foto']);

            $usuarios[] = $u;
        }
        return $usuarios;
    }

    //FIND ----------------xxxx--------------------------------
    public static function find($id):Post{
        $conexao = new MySQL();
        $sql = "SELECT * FROM usuario WHERE id = {$id}";
        $resultado = $conexao->consulta($sql);
        
        $u = new User();
        $u->setEmail($resultado['0']['email']);
        $u->setSenha($resultado['0']['senha']);
        $u->setId($resultado['0']['id']);
        $u->setNome($resultado['0']['nome']);
        $u->setBio($resultado['0']['bio']);

        $u->setTurma($resultado['0']['turma']); //retorna o numero da turma
        $u->setFoto($resultado['0']['foto']);

        return $u;
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

        if(empty($this->descricao)){
            $sql = "INSERT INTO post (criador,usuario,foto,dataCriacao) VALUES ('{$this->criador}','{$this->criador}','{$this->foto}',CURRENT_TIMESTAMP())";
        }else{
            $sql = "INSERT INTO post (criador,usuario,foto,descricao,dataCriacao) VALUES ('{$this->criador}','{$this->criador}','{$this->foto}','{$this->descricao}',CURRENT_TIMESTAMP())";
        }

        return $conexao->executa($sql);
    }
}
