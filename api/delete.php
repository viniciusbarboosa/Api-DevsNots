<?php
require('../conexao.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);
if($method === 'delete'){

    //PEGAR DA RAIZ POIS O METODO PUT NAO DA PRA PEGAR USADNO O GET
    parse_str(file_get_contents('php://input'),$input);

    $id = (!empty($input['id'])) ? $input['id'] : null;
  
    $id = filter_var($id);

    if($id){

        $sql = $pdo->prepare("SELECT * FROM notes where id = :id");
        $sql->bindValue(':id',$id);
        $sql->execute();


        if($sql->rowCount() > 0){

            $sql = $pdo->prepare("DELETE FROM notes WHERE id = :id");
            $sql->bindValue(':id' , $id);
            $sql->execute();

        }else{
            $array['error'] = 'ID INEXISTENTE';
        }

    }else{
        $array['error'] = 'ID NÃO ENVIADO';
    }
}else{
    $array['error'] = 'METODO NÃO PERMITIDO (permite apenas DELETE)';
}



require('../retorno.php');