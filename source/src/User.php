<?php

require_once __DIR__ . "/MySQL.php";
require_once __DIR__ . "/ActiveRecord.php";
require_once __DIR__ . '/../config/filterStrings.php';


class User implements ActiveRecord
{

    private string $email;
    private string $senha;
    private int $id;
    private int $likes;
    private $foto;
    private string $bio;
    private string $nome;
    private $turma;

    //ID ------------------------------------------------
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getId(): int
    {
        return $this->id;
    }

    //likes ------------------------------------------------
    public function setLikes(int $likes): void
    {
        $this->likes = $likes;
    }
    public function getLikes(): int
    {
        return $this->likes;
    }

    //SENHA ------------------------------------------------
    public function setSenha($senha): void
    {
        $this->senha = $senha;
    }
    public function getSenha(): string
    {
        return $this->senha;
    }

    //EMAIL ------------------------------------------------
    public function setEmail($email): void
    {
        $this->email = filterString($email);
    }
    public function getEmail(): string
    {
        return $this->email;
    }

    //NOME ------------------------------------------------
    public function setNome(string $nome): void
    {
        $this->nome = filterString($nome);
    }
    public function getNome(): string
    {
        return $this->nome;
    }
    //BIO ------------------------------------------------
    public function setBio(string $bio): void
    {
        $this->bio = filterString($bio);
    }
    public function getBio(): string
    {
        return $this->bio;
    }
    //TURMA ------------------------------------------------
    public function setTurma($turma): void
    {
        $this->turma = $turma;
    }
    public function getTurma()
    {
        return $this->turma;
    }
    //FOTO ------------------------------------------------
    public function setFoto($foto): void
    {
        $this->foto = $foto;
    }
    public function getFoto()
    {
        return $this->foto;
    }

    //FINDPROFILE ------------------------------------------------
    public static function findUsersRanking(): array
    {
        $conexao = new MySQL();

        $sqlUser = "SELECT usuario.nome, usuario.foto, usuario.likes, turma.curso
        FROM usuario 
        INNER JOIN turma ON turma.id = usuario.turma
        ORDER BY usuario.likes DESC
        LIMIT 20";

        $usuariosBanco = $conexao->consulta($sqlUser);

        $usuarios = array();
        foreach ($usuariosBanco as $usuario) {

            $u = new User();
            $u->setNome($usuario['nome']);
            $u->setTurma($usuario['curso']);
            $u->setfoto($usuario['foto']);
            $u->setLikes($usuario['likes']);

            $usuarios[] = $u;
        }
        return $usuarios;
    }

    //FINDPROFILE ------------------------------------------------
    public static function findUser($nome): array
    {
        $nomeUsuarioPesquisar = filterString($nome);

        $sqlUser = "SELECT usuario.nome, usuario.foto, turma.curso 
        FROM usuario 
        INNER JOIN turma ON turma.id = usuario.id
        WHERE nome like '{$nomeUsuarioPesquisar}'";

        $conexao = new MySQL();

        $usuariosBanco = $conexao->consulta($sqlUser);

        $usuarios = array();
        foreach ($usuariosBanco as $usuario) {

            $u = new User();
            $u->setNome($usuario['nome']);
            $u->setTurma($usuario['curso']);
            $u->setfoto($usuario['foto']);

            $usuarios[] = $u;
        }
        return $usuarios;
    }

    //FINDPROFILE ------------------------------------------------
    public static function findUserSuggestion(): array
    {

        $sqlUser = "SELECT usuario.nome, usuario.foto, turma.curso 
        FROM usuario 
        INNER JOIN turma ON turma.id = usuario.turma
        WHERE usuario.id != '{$_SESSION['idSession']}' 
        LIMIT 30";

        $conexao = new MySQL();
        $usuariosBanco = $conexao->consulta($sqlUser);

        $usuarios = array();
        foreach ($usuariosBanco as $usuario) {

            $u = new User();
            $u->setNome($usuario['nome']);
            $u->setTurma($usuario['curso']);
            $u->setfoto($usuario['foto']);

            $usuarios[] = $u;
        }
        return $usuarios;
    }

    //FINDPROFILE ------------------------------------------------
    public static function findProfile($nome)
    {

        $conexao = new MySQL();
        $sqlUser = "SELECT usuario.id, usuario.nome, turma.curso, usuario.bio, usuario.foto, usuario.likes 
        FROM usuario
        INNER JOIN turma ON usuario.turma = turma.id 
        WHERE nome = '{$nome}'";

        $user = $conexao->consulta($sqlUser);

        if (!empty($user)) {
            $u = new User();
            $u->setId($user['0']['id']);
            $u->setNome($user['0']['nome']);
            $u->setTurma($user['0']['curso']);
            $u->setBio($user['0']['bio']);
            $u->setLikes($user['0']['likes']);
            $u->setfoto($user['0']['foto']);
            return $u;
        }
        return false;
    }

    //FIND ------------------------------------------------
    public static function find($id): User
    {
        $conexao = new MySQL();

        $sql = "SELECT * FROM usuario WHERE id = {$id}";
        $resultado = $conexao->consulta($sql);

        $u = new User();
        $u->setEmail($resultado['0']['email']);
        $u->setSenha($resultado['0']['senha']);
        $u->setId($resultado['0']['id']);
        $u->setNome($resultado['0']['nome']);
        $u->setBio($resultado['0']['bio']);

        $u->setTurma($resultado['0']['turma']);
        $u->setFoto($resultado['0']['foto']);

        return $u;
    }

    //DELETE ------------------------------------------------
    public function delete(): bool
    {
        $conexao = new MySQL();

        if ($this->foto != 'profileDefault.jpg') {
            unlink("../photos/profile/" . $this->foto);
        }
        $postsProfile = Post::findProfilePost($this->nome);
        if (count($postsProfile)) {
            foreach ($postsProfile as $post) {
                $post->delete();
            }
        }

        $sql = "DELETE FROM usuario WHERE id = {$this->id}";
        return $conexao->executa($sql);
    }

    //SALVAR ------------------------------------------------
    public function save(): bool
    {
        $conexao = new MySQL();

        if (isset($this->senha)) {
            $senhaHash = password_hash($this->senha, PASSWORD_BCRYPT);
        }

        if (!empty($this->foto) && $this->foto != "profileDefault.jpg") {
            $typesImg = array("JPG", "JPEG", "GIF", "PNG", "SVG", "PSD", "WEBP", "RAW", "TIFF", "BMP", "JFIF", "jpg", "gif", "png", "svg", "psd", "webp", "raw", "tiff", "bmp", "jpeg", "jfif");

            $diretorio = __DIR__ . "/../photos/profile/";
            $nome_arquivo = $this->foto;
            $info_name = explode(".", $nome_arquivo);
            $extensao = end($info_name);
            if (!in_array($extensao, $typesImg)) {
                return false;
            }
            $this->foto = uniqid() . "." . $extensao;
            move_uploaded_file($_FILES["foto"]["tmp_name"], $diretorio . $this->foto);
        }

        if (isset($this->id)) {
            $_SESSION['nameSession'] = $this->nome;

            $sql = "UPDATE usuario SET email = '{$this->email}', nome = '{$this->nome}' ,turma = '{$this->turma}', bio = '{$this->bio}' WHERE id = {$this->id}";

            if (!empty($senhaHash) && !empty($this->foto)) {
                $sql = "UPDATE usuario SET email = '{$this->email}',senha = '{$senhaHash}'
                ,nome = '{$this->nome}' ,turma = '{$this->turma}', bio = '{$this->bio}', foto = '{$this->foto}' WHERE id = {$this->id}";
            } elseif (!empty($senhaHash)) {
                $sql = "UPDATE usuario SET email = '{$this->email}',senha = '{$senhaHash}'
                ,nome = '{$this->nome}' ,turma = '{$this->turma}', bio = '{$this->bio}' WHERE id = {$this->id}";
            } elseif (!empty($this->foto)) {
                $sql = "UPDATE usuario SET email = '{$this->email}', nome = '{$this->nome}' ,turma = '{$this->turma}', bio = '{$this->bio}', foto = '{$this->foto}' WHERE id = {$this->id}";
            }
        } else {
            $sql = "INSERT INTO usuario (email,senha,nome,turma,bio) VALUES ('{$this->email}','{$senhaHash}','{$this->nome}','{$this->turma}', '{$this->bio}')";

            if (!empty($this->foto))
                $sql = "INSERT INTO usuario (email,senha,nome,turma,bio,foto) VALUES ('{$this->email}','{$senhaHash}','{$this->nome}','{$this->turma}','{$this->bio}','{$this->foto}')";
        }

        return $conexao->executa($sql);
    }

    //AUTENTICAR ------------------------------------------------
    public function authenticate(): bool
    {
        $conexao = new MySQL();
        $sql = "SELECT id,senha,nome FROM usuario WHERE email = '{$this->email}'";
        $resultados = $conexao->consulta($sql);

        if (empty($resultados)) {
            return false;
        } else {
            if (password_verify($this->senha, $resultados['0']['senha'])) {
                session_start();
                $_SESSION['idSession'] = $resultados['0']['id'];
                $_SESSION['nameSession'] = $resultados['0']['nome'];

                return true;
            } else {
                return false;
            }
        }
    }

    //VALIDAR ------------------------------------------------
    public function validate(): bool
    {
        $conexao = new MySQL();
        if (isset($this->id)) {
            $sql = "SELECT id FROM usuario WHERE (email = '{$this->email}' OR nome = '{$this->nome}') AND id != '{$this->id}'";
        } else {
            $sql = "SELECT id FROM usuario WHERE email = '{$this->email}' OR nome = '{$this->nome}'";
        }

        $resultados = $conexao->consulta($sql);

        if (empty($resultados)) {
            return true;
        } else {
            return false;
        }
    }
}
