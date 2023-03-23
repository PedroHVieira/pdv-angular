<?php

use Util\Constantes;
use Util\JsonUtil;
use Util\Rotas;
use Validator\RequestValidator;

include 'config.php';

try{        
    $request = new RequestValidator(Rotas::getRotas());    
    $retorno = $request->processarRequest();    
    
    $jsonUtil = new JsonUtil();
    $jsonUtil->processarArray($retorno);

}catch(Exception $e){
    echo json_encode([
        Constantes::TIPO => Constantes::TIPO_ERRO,
        Constantes::RESPOSTA => $e->getMessage()
    ]);
}

?>