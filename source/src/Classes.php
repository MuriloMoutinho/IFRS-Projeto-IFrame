<?php

require_once __DIR__ . "/MySQL.php";

class Classes
{

    private int $id;
    private String $curso;

    //ID ------------------------------------------------
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getId(): int
    {
        return $this->id;
    }

    //CURSO ------------------------------------------------
    public function setCurso(String $curso): void
    {
        $this->curso = $curso;
    }
    public function getCurso(): String
    {
        return $this->curso;
    }


    //FIND ------------------------------------------------
    public static function find(): array
    {
        $conexao = new MySQL();
        $sql = "SELECT * FROM turma order by id asc";
        $resultadoBanco = $conexao->consulta($sql);
        $turmas = array();
        foreach($resultadoBanco as $turma){
            
            $c = new Classes();
            $c->setCurso($turma['curso']);
            $c->setId($turma['id']);

            $turmas[] = $c;

        }
        
        return $turmas;
    }

}
