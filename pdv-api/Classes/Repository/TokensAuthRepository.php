<?php
namespace Repository;

use DB\PostgreSQL;
use InvalidArgumentException;
use Util\Constantes;

class TokensAuthRepository{
    
    private object $postgre;
    private const TABELA  = 'tokens_auth';
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(){
        $this->postgre = new PostgreSQL();        
    }
    
    /**
     * validarToken
     *
     * @param  mixed $token
     * @return void
     */
    public function validarToken($token){
        $token = str_replace([' ','Bearer'], '', $token);

        if($token){
            $consultaToken = 'SELECT id FROM ' .self::TABELA. ' WHERE toke_token = :token AND toke_status = :status';
 
            $stmt = $this->getPostgre()->getDB()->prepare($consultaToken);
            $stmt->bindValue(':token', $token);
            $stmt->bindValue(':status', 'ativo');
            $stmt->execute();

            if($stmt->rowCount() !== 1){                
                http_response_code(401);
                throw new InvalidArgumentException(Constantes::MSG_ERRO_TOKEN_NAO_AUTORIZADO);
            }
            
        }else{
            throw new InvalidArgumentException(Constantes::MSG_ERRO_TOKEN_VAZIO);
        }
    }
    
    /**
     * getPostgre
     *
     * @return void
     */
    public function getPostgre(){
        return $this->postgre;
    }
}

?>