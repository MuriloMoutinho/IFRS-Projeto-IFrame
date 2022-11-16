<?php

class User implements ActiveRecord{

    private int $idUsuario;
    private int $foto;
    private int $bio;


    public function __construct(private string $email,private string $senha,private string $nome, private string $turma){
    }


    //ID ------------------------------------------------
    public function getIdUsuario():int{
        return $this->idUsuario;
    }

    //SENHA ------------------------------------------------
    public function setSenha(string $senha):void{
        $this->senha = $senha;
    }

    public function getSenha():string{
        return $this->senha;
    }

    //EMAIL ------------------------------------------------
    public function getEmail():string{
        return $this->email;
    }




    //SALVAR ------------------------------------------------
    public function save():bool{
        $conexao = new MySQL();
        $this->senha = password_hash($this->senha,PASSWORD_BCRYPT); 
        if(isset($this->idUsuario)){
            $sql = "UPDATE usuario SET email = '{$this->email}' ,senha = '{$this->senha}' ,nome = '{$this->nome} ,turma = '{$this->turma}' WHERE id = {$this->idUsuario}";
        }else{
            $sql = "INSERT INTO usuario (email,senha,nome,turma) VALUES ('{$this->email}','{$this->senha}','{$this->nome}','{$this->turma}')";
        }
        return $conexao->executa($sql);
    }

    //FIND ------------------------------------------------
    public static function find($idUsuario):Usuario{
        $conexao = new MySQL();
        $sql = "SELECT * FROM usuarios WHERE idUsuario = {$idUsuario}";
        $resultado = $conexao->consulta($sql);
        $u = new Usuario($resultado[0]['email'],$resultado[0]['senha']);
        $u->setIdUsuario($resultado[0]['idUsuario']);
        return $u;
    }
    public static function findall():array{
        $conexao = new MySQL();
        $sql = "SELECT * FROM usuarios";
        $resultados = $conexao->consulta($sql);
        $usuarios = array();
        foreach($resultados as $resultado){
            $u = new Usuario($resultado['email'],$resultado['senha']);
            $u->setIdUsuario($resultado['idUsuario']);
            $usuarios[] = $u;
        }
        return $usuarios;
    }


    //DELETE ------------------------------------------------
    public function delete():bool{
        $conexao = new MySQL();
        $sql = "DELETE FROM usuario WHERE id = {$this->idUsuario}";
        return $conexao->executa($sql);
    }

    //AUTENTICAR ------------------------------------------------
    public function authenticate():bool{
        $conexao = new MySQL();
        $sql = "SELECT id,senha FROM usuario WHERE email = '{$this->email}'";
        $resultados = $conexao->consulta($sql);
        if(password_verify($this->senha,$resultados[0]['senha'])){
            session_start();
            $_SESSION['id'] = $resultados[0]['id'];
            $_SESSION['email'] = $resultados[0]['email'];
            return true;
        }else{
            return false;
        }
    }
    
}
