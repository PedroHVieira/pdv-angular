<?php 

namespace Util;

use Exception;
use InvalidArgumentException;
use JsonException;

class JsonUtil{

    public static function tratrCorpoRequisicao(){
        try{
            $postJson = json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR);            
            
        }catch(JsonException $e){
            throw new InvalidArgumentException(Constantes::MSG_ERRO_JSON_VAZIO);
        }

        if(is_array($postJson) && count($postJson) > 0){
            return $postJson;
        }
    }

    public function processarArray($retorno){
        $dados = [];
        $dados[Constantes::TIPO] = Constantes::TIPO_ERRO;

        if((is_array($retorno) && count($retorno) > 0) || strlen($retorno) > 10 ){
            $dados[Constantes::TIPO] = Constantes::TIPO_SUCESSO;
            $dados[Constantes::RESPOSTA] = $retorno;
        }

        $this->retornarJson($dados);
    }

    private function retornarJson($json){
        header('Content-Type: application/json'); 
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        
        echo json_encode($json);
        exit;
    }

}

?>