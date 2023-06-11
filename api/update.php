<?php
require('../conexao.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);
if($method === 'put'){

    //PEGAR DA RAIZ POIS O METODO PUT NAO DA PRA PEGAR USADNO O GET
    parse_str(file_get_contents('php://input'),$input);

    $id = (!empty($input['id'])) ? $input['id'] : null;
    $title = (!empty($input['title'])) ? $input['title'] : null;
    $body = (!empty($input['body'])) ? $input['body'] : null;
  
    $id = filter_var($id);
    $title = filter_var($title);
    $body = filter_var($body);

    if($id && $title && $body){

        $sql = $pdo->prepare("SELECT * FROM notes where id = :id");
        $sql->bindValue(':id',$id);
        $sql->execute();


        if($sql->rowCount() > 0){

            $sql = $pdo->prepare("UPDATE notes SET title = :title, body = :body WHERE id = :id");
            $sql->bindValue(':id' , $id);
            $sql->bindValue(':body' , $body);
            $sql->bindValue(':title' , $title);
            $sql->execute();

            //DEVOLVE RESULTADO ATUALIZADO
            $array['result'] = [
                'id' => $id,
                'title' => $title,
                'body' => $body
            ];
        }else{
            $array['error'] = 'ID INEXISTENTE';
        }

    }else{
        $array['error'] = 'DADOS NÃO ENVIADOS';
    }
}else{
    $array['error'] = 'METODO NÃO PERMITIDO (permite apenas PUT)';
}



require('../retorno.php');