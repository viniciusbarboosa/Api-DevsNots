<?php
require('../conexao.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);
if($method === 'get'){

    $id = filter_input(INPUT_GET,'id');

    if($id){

        $sql = $pdo->prepare("SELECT * FROM notes WHERE id = :id");
        $sql->bindValue(':id',$id);
        $sql->execute();


        if($sql->rowCount()>0){
            $data = $sql->fetch(PDO::FETCH_ASSOC);

            $array['result'] = [
                'id' => $data['id'],
                'title' => $data['title'],
                'body' => $data['body']
            ];
            
        }else{
            $array['error'] = 'ID INEXISTENTE';
        }

    }else{
        $array['error'] = 'ID NÂO ENVIADO';
    }
    
}else{
    $array['error'] = 'METODO NÃO PERMITIDO (permite apenas GET)';
}



require('../retorno.php');