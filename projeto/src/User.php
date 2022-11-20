<?php

require 'ActiveRecord.php';
require 'MySQL.php';

class User implements ActiveRecord{

    private int $id;
    private $foto;
    private string $bio;
    private string $nome;
    private string $turma;

    public function __construct(private string $email,private string $senha){
    }


    //ID ------------------------------------------------
    public function setId(int $id):void{
        $this->id = $id;
    }
    public function getId():int{
        return $this->id;
    }

    //SENHA ------------------------------------------------
    public function getSenha():string{
        return $this->senha;
    }

    //EMAIL ------------------------------------------------
    public function getEmail():string{
        return $this->email;
    }

    //NOME ------------------------------------------------
    public function setNome(string $nome):void{
        $this->nome = $nome;
    }
    public function getNome():string{
        return $this->nome;
    }
    //BIO ------------------------------------------------
    public function setBio(string $bio):void{
        $this->bio = $bio;
    }
    public function getBio():string{
        return $this->bio;
    }
    //TURMA ------------------------------------------------
    public function setTurma(string $turma):void{
    $this->turma = $turma;
    }
    public function getTurma():string{
        return $this->turma;
    }
    //FOTO ------------------------------------------------
    public function setFoto($foto):void{
    $this->foto = $foto;
    }
    public function getFoto(){
        return $this->foto;
    }


    //FINDPROFILE ------------------------------------------------
    public static function findProfile($id):User{
        $conexao = new MySQL();
        $sql = "SELECT * FROM usuario WHERE id = {$id}";
        $resultado = $conexao->consulta($sql);

        $u = new User();
        $u->setId($resultado[0]['id']);
        $u->setNome($resultado['0']['nome']);
        $u->setTurma($resultado['0']['turma']);
        $u->setBio($resultado['0']['bio']);
        $u->setfoto($resultado['0']['foto']);
        return $u;
    }

    //FIND ----------------xxxx--------------------------------
    public static function find($id):User{
        $conexao = new MySQL();
        $sql = "SELECT * FROM usuario WHERE id = {$id}";
        $resultado = $conexao->consulta($sql);
        
        $u = new User($resultado['0']['email'],$resultado['0']['senha']);
        $u->setId($resultado['0']['id']);
        $u->setNome($resultado['0']['nome']);
        $u->setBio($resultado['0']['bio']);
        $u->setTurma($resultado['0']['turma']);
        $u->setFoto($resultado['0']['foto']);

        return $u;
    }
    public static function findall():array{
        $conexao = new MySQL();
        $sql = "SELECT * FROM usuarios";
        $resultados = $conexao->consulta($sql);
        $usuarios = array();
        foreach($resultados as $resultado){
            $u = new Usuario($resultado['email'],$resultado['senha']);
            $u->setid($resultado['id']);
            $usuarios[] = $u;
        }
        return $usuarios;
    }


    //DELETE ------------------------------------------------
    public function delete():bool{
        $conexao = new MySQL();
        $sql = "DELETE FROM usuario WHERE id = {$this->id}";
        return $conexao->executa($sql);
    }

    //SALVAR ------------------------------------------------
    public function save():bool{
        $conexao = new MySQL();
        $this->senha = password_hash($this->senha,PASSWORD_BCRYPT); 

        //unlink("../photos/profile/".$this->foto);

        if(!empty($this->foto)){
            $diretorio = "photos/profile/";
            $nome_arquivo = $this->foto;
            $info_name = explode(".",$nome_arquivo);
            $extensao = end($info_name);
            $this->foto = uniqid().".".$extensao;
            move_uploaded_file($_FILES["foto"]["tmp_name"], $diretorio.$this->foto);
        } 

        if(isset($this->id)){
            $sql = "UPDATE usuario SET email = '{$this->email}' ,senha = '{$this->senha}' ,nome = '{$this->nome}' ,turma = '{$this->turma}' WHERE id = {$this->id}";

            if(!empty($this->bio) && !empty($this->foto)){
                $sql = "UPDATE usuario SET email = '{$this->email}' ,senha = '{$this->senha}' ,nome = '{$this->nome}' ,turma = '{$this->turma}', bio = '{$this->bio}', foto = '{$this->foto}' WHERE id = {$this->id}";

            }else if(!empty($this->bio)){
                $sql = "UPDATE usuario SET email = '{$this->email}' ,senha = '{$this->senha}' ,nome = '{$this->nome}' ,turma = '{$this->turma}', bio = '{$this->bio}'";

            }else if(!empty($this->foto)){
                $sql = "UPDATE usuario SET email = '{$this->email}' ,senha = '{$this->senha}' ,nome = '{$this->nome}' ,turma = '{$this->turma}', foto = '{$this->foto}' WHERE id = {$this->id}";
            }
        
            }else{
            $sql = "INSERT INTO usuario (email,senha,nome,turma) VALUES ('{$this->email}','{$this->senha}','{$this->nome}','{$this->turma}')";
            if(!empty($this->bio) && !empty($this->foto)){
                $sql = "INSERT INTO usuario (email,senha,nome,turma,bio,foto) VALUES ('{$this->email}','{$this->senha}','{$this->nome}','{$this->turma}','{$this->bio}','{$this->foto}')";

            }else if(!empty($this->bio)){
                $sql = "INSERT INTO usuario (email,senha,nome,turma,bio) VALUES ('{$this->email}','{$this->senha}','{$this->nome}','{$this->turma}','{$this->bio}')";

            }else if(!empty($this->foto))
                $sql = "INSERT INTO usuario (email,senha,nome,turma,foto) VALUES ('{$this->email}','{$this->senha}','{$this->nome}','{$this->turma}','{$this->foto}')";
            }

        return $conexao->executa($sql);
    }

    //AUTENTICAR ------------------------------------------------
    public function authenticate():bool{
        $conexao = new MySQL();
        $sql = "SELECT id,senha FROM usuario WHERE email = '{$this->email}'";
        $resultados = $conexao->consulta($sql);

        if(password_verify($this->senha,$resultados[0]['senha'])){
            session_start();
            $_SESSION['idSession'] = $resultados[0]['id'];
            $_SESSION['emailSession'] = $this->email;
            return true;
        }else{
            return false;
        }
    }
    
     //VALIDAR ------------------------------------------------
     public function validate():bool{
        $conexao = new MySQL();
        if(isset($this->id)){
            $sql = "SELECT id FROM usuario WHERE (email = '{$this->email}' OR nome = '{$this->nome}') AND id != '{$this->id}'";
        }else{
        $sql = "SELECT id FROM usuario WHERE email = '{$this->email}' OR nome = '{$this->nome}'";
        }

        $resultados = $conexao->consulta($sql);

        if(empty($resultados)){
            return true;
        }else{
            return false;
        }
    }

}
