<?php

require_once __DIR__."/MySQL.php";
require_once __DIR__."/ActiveRecord.php";


class User implements ActiveRecord{

    private string $email;
    private string $senha;
    private int $id;
    private $foto;
    private string $bio;
    private string $nome;
    private $turma;

    //ID ------------------------------------------------
    public function setId(int $id):void{
        $this->id = $id;
    }
    public function getId():int{
        return $this->id;
    }

    //SENHA ------------------------------------------------
    public function setSenha($senha):void{
        $this->senha = $senha;
    }
    public function getSenha():string{
        return $this->senha;
    }

    //EMAIL ------------------------------------------------
    public function setEmail($email):void{
        $this->email = $email;
    }
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
    public function setTurma($turma):void{
    $this->turma = $turma;
    }
    public function getTurma(){
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
        public static function findUsersRanking():array{
            $conexao = new MySQL();
            
            $sqlUser = "SELECT usuario.nome,usuario.foto,usuario.turma, COUNT(post_curtida.id) as numeroLikes
            FROM usuario 
            INNER JOIN post ON post.criador = usuario.id
            INNER JOIN post_curtida ON post_curtida.post = post.id
            GROUP BY usuario.nome
            ORDER BY numeroLikes DESC
            LIMIT 15";

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

    //FINDPROFILE ------------------------------------------------
    public static function findUser($nome, $limit):array{
        $userSearch = "%".trim($nome)."%";
        
        if($limit == 0){
            $sqlUser = "SELECT nome,foto,turma FROM usuario WHERE nome like '{$userSearch}'";
        }else{
            $sqlUser = "SELECT nome,foto,turma FROM usuario WHERE nome like '{$userSearch}' LIMIT {$limit}";
        }

        $conexao = new MySQL();
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

    //FINDPROFILE ------------------------------------------------
    public static function findProfile($nome):User{

        $conexao = new MySQL();
        $sqlUser = "SELECT usuario.nome,turma.curso,usuario.bio,usuario.foto FROM usuario, turma WHERE usuario.turma = turma.id AND nome = '{$nome}'";

        $user = $conexao->consulta($sqlUser);

        $u = new User();
        $u->setNome($user['0']['nome']);
        $u->setTurma($user['0']['curso']); //retorna o nome da turma
        $u->setBio($user['0']['bio']);
        
        $u->setfoto($user['0']['foto']);
        return $u;
    }

    //FIND ----------------xxxx--------------------------------
    public static function find($id):User{
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

    //count ------------------------------------------------
    public function countLikesProfile():String{
        $conexao = new MySQL();

        $sqlPosts = "SELECT post.id FROM usuario, post WHERE usuario.id = post.criador AND nome = '{$this->nome}'";
        $postsBanco = $conexao->consulta($sqlPosts);

        $totalLikes = 0;
        foreach($postsBanco as $post){
            $totalLikes += Like::countLikesPost($post['id']);
        }

        return $totalLikes;
    }


    //DELETE ------------------------------------------------
    public function delete():bool{
        $conexao = new MySQL();
        
        unlink("../photos/profile/".$this->foto);
        $postsProfile = Post::findProfilePost($this->nome);
        if(count($postsProfile)){
            foreach($postsProfile as $post){
                $post->delete();
            }
        }

        $sql = "DELETE FROM usuario WHERE id = {$this->id}";
        return $conexao->executa($sql);
    }

    //SALVAR ------------------------------------------------
    public function save():bool{
        $conexao = new MySQL();
        
        if(isset($this->senha)){
            $this->senha = password_hash($this->senha,PASSWORD_BCRYPT); 
        }

        if(!empty($this->foto) && $this->foto != "profileDefault.jpg"){
            $diretorio = "photos/profile/";
            $nome_arquivo = $this->foto;
            $info_name = explode(".",$nome_arquivo);
            $extensao = end($info_name);
            $this->foto = uniqid().".".$extensao;
            move_uploaded_file($_FILES["foto"]["tmp_name"], $diretorio.$this->foto);
        } 

        if(isset($this->id)){
            $_SESSION['nameSession'] = $this->nome;

            $sql = "UPDATE usuario SET email = '{$this->email}', nome = '{$this->nome}' ,turma = '{$this->turma}', bio = '{$this->bio}' WHERE id = {$this->id}";

            if(!empty($this->senha) && !empty($this->foto)){
                $sql = "UPDATE usuario SET email = '{$this->email}',senha = '{$this->senha}'
                ,nome = '{$this->nome}' ,turma = '{$this->turma}', bio = '{$this->bio}', foto = '{$this->foto}' WHERE id = {$this->id}";
            }elseif(!empty($this->senha)){
                $sql = "UPDATE usuario SET email = '{$this->email}',senha = '{$this->senha}'
                ,nome = '{$this->nome}' ,turma = '{$this->turma}', bio = '{$this->bio}' WHERE id = {$this->id}";
            }elseif (!empty($this->foto)) {
              $sql = "UPDATE usuario SET email = '{$this->email}', nome = '{$this->nome}' ,turma = '{$this->turma}', bio = '{$this->bio}', foto = '{$this->foto}' WHERE id = {$this->id}";
            }
        
        }else{
            $sql = "INSERT INTO usuario (email,senha,nome,turma,bio) VALUES ('{$this->email}','{$this->senha}','{$this->nome}','{$this->turma}', '{$this->bio}')";

            if(!empty($this->foto))
                $sql = "INSERT INTO usuario (email,senha,nome,turma,bio,foto) VALUES ('{$this->email}','{$this->senha}','{$this->nome}','{$this->turma}','{$this->bio}','{$this->foto}')";
            }

        return $conexao->executa($sql);
    }

    //AUTENTICAR ------------------------------------------------
    public function authenticate():bool{
        $conexao = new MySQL();
        $sql = "SELECT id,senha,nome FROM usuario WHERE email = '{$this->email}'";
        $resultados = $conexao->consulta($sql);

        if(password_verify($this->senha,$resultados['0']['senha'])){
            session_start();
            $_SESSION['idSession'] = $resultados['0']['id'];
            $_SESSION['nameSession'] = $resultados['0']['nome'];

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
