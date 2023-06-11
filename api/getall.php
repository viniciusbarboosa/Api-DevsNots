<?php 
require('../conexao.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);
if($method === 'get'){

    $sql = $pdo->prepare('SELECT * FROM notes');
    $sql->execute();

    if($sql->rowCount() > 0){
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($data as $item){
            $array['result'][]=[
               'id' => $item['id'], 
               'title' => $item['title'],
               'body' => $item['body']
            ];
        }
    }
    
}else{
    $array['error'] = 'METODO NÃO PERMITIDO (permite apenas GET)';
}



require('../retorno.php');