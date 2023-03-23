<?php
namespace Validator;

use InvalidArgumentException;
use Repository\TokensAuthRepository;
use Service\ProdutoService;
use Util\Constantes;
use Util\JsonUtil;

class RequestValidator{

    private $request;
    private $dadosRequest = [];
    private object $tokenAuth;
    
    /**
     * __construct
     *
     * @param  mixed $request
     * @return void
     */
    public function __construct($request) {
        $this->request = $request;         
        $this->tokenAuth = new TokensAuthRepository();
    }
    
    /**
     * processarRequest
     *
     * @return void
     */
    public function processarRequest(){        
        $retorno = Constantes::MSG_ERRO_TIPO_ROTA;
        
        if(in_array($this->request['metodo'], Constantes::TIPO_REQUEST, true)){            
            $retorno = $this->direcionarRequest();
        }

        return $retorno;
    }
    
    /**
     * direcionarRequest
     *
     * @return void
     */
    private function direcionarRequest(){        
        if($this->request['metodo'] !== 'GET' && $this->request['metodo'] !== 'DELETE'){            
            $this->dadosRequest = JsonUtil::tratrCorpoRequisicao();            
        }

        
        
        $this->tokenAuth->validarToken(getallheaders()['Authorization']);
        $metodo = $this->request['metodo'];
        
        return $this->$metodo();        
    }
    
    /**
     * get
     *
     * @return void
     */
    private function get(){
        $retorno = Constantes::MSG_ERRO_TIPO_ROTA;

        if(in_array($this->request['rota'], Constantes::TIPO_GET, true)){                   
            $produtoService = new ProdutoService($this->request);
            $retorno = $produtoService->validarGet($this->request['rota']);  
        }

        return $retorno;
    }
    
    /**
     * delete
     *
     * @return void
     */
    private function delete(){
        $retorno = Constantes::MSG_ERRO_TIPO_ROTA;

        if(in_array($this->request['rota'], Constantes::TIPO_DELETE, true)){            
            $produtoService = new ProdutoService($this->request);
            $retorno = $produtoService->validarDelete($this->request['rota']);
        }

        return $retorno;
    }
    
    /**
     * post
     *
     * @return void
     */
    private function post(){
        $retorno = Constantes::MSG_ERRO_TIPO_ROTA;

        if(in_array($this->request['rota'], Constantes::TIPO_POST, true)){            
            $produtoService = new ProdutoService($this->request);
            $produtoService->setDadosCorpoRequest($this->dadosRequest);
            $retorno = $produtoService->validarPost($this->request['rota']);
        }

        return $retorno;
    }
    
    /**
     * put
     *
     * @return void
     */
    private function put(){
        $retorno = Constantes::MSG_ERRO_TIPO_ROTA;

        if(in_array($this->request['rota'], Constantes::TIPO_PUT, true)){            
            $produtoService = new ProdutoService($this->request);
            $produtoService->setDadosCorpoRequest($this->dadosRequest);
            $retorno = $produtoService->validarPut($this->request['rota']);                    
        }

        return $retorno;
    }

}

?>