<?php

session_start();

require_once 'Base.php';

class Aluno extends Base{

    public function select() {
        $data = (object) $_POST;

        $db = $this->getDb();
        $stm = $db->prepare('SELECT aluno.nome, aluno.email, aluno.idade, aluno.sexo, curso.curso FROM aluno INNER JOIN curso ON curso.idcurso = aluno.idcurso');
        $stm->execute();
        $result = $stm->fetchAll( PDO::FETCH_ASSOC);

        foreach ($result as $key => $value) {
            $result[$key]["nome"] = utf8_encode($result[$key]["nome"]);
            $result[$key]["curso"] = utf8_encode($result[$key]["curso"]);
        }

        // if(isset($result[0]["idaluno"])){
        //     $success = true;
        // }else{
        //     $success = false;
        // }

        echo json_encode(array(
            "data" => $result,
            "success" => true
            )
        );
        
    }
}

$acao = $_POST["action"];

$aluno = new Aluno();
$aluno->$acao();
?>
