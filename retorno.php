<?php
//PERMITE QUE QUALQUER SITE FAÇA UMA REQUISIÇÃO
header("Access-Control-Allow-Origin: *");
//PERMITE TODOS OS METODOS DE REQ
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS");
//PERMITE QUE SEMPRE RETORNE JSON
header("Content-Type: aplication/json");
echo json_encode($array);
exit;