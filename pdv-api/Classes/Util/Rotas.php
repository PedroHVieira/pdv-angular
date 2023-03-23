<?php
namespace Util;

use InvalidArgumentException;

class Rotas{
    
    /**
     * getRotas
     *
     * @return void
     */
    public static function getRotas(){
        $urls = self::getUrls();        

        Rotas::validarUrl($urls);

        //INICIALIZAR A VAR REQUEST PRAR VALIDAÇÕES     
        $request['rota'] = strtoupper($urls[0]);
        $request['acao'] = $urls[1] ?? null;
        $request['id'] = $urls[2] ?? null;
        $request['metodo'] = $_SERVER['REQUEST_METHOD'];
        
        return $request;
    }
    
    /**
     * getUrls
     *
     * @return void
     */
    public static function getUrls(){
        //ARMAZENAR QUAL O DIRETÓRIO ESCOLHIDO
        $uri =str_replace('/'.DIR_PROJETO, '', $_SERVER['REQUEST_URI']);
        return explode('/', trim($uri,'/'));
    }
    
    /**
     * validarUrl
     *
     * @param  mixed $urls
     * @return void
     */
    private static function validarUrl($urls){
        $retorno = true;

        if(count($urls) > 2){
            $key = filter_var($urls[2], FILTER_VALIDATE_INT);
        
            if($urls[2] && $key === false){
                $retorno = false;
            }
        }        

        if (preg_match("/^[a-zA-Z]+$/", $urls[0]) == 0 || preg_match("/^[a-zA-Z]+$/", $urls[1]) == 0) {
            $retorno = false;
        }

        if(!$retorno){
            throw new InvalidArgumentException(Constantes::MSG_PARAMETRO_NAO_AUTORIZADO);
        }        
    } 

}

?>