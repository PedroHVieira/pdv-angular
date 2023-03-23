<?php
namespace Service;

use InvalidArgumentException;
use Repository\ProdutoRepository;
use Repository\CategoriaRepository;
use Repository\PedidoRepository;
use Util\Constantes;

class ProdutoService{
    
    private $dados = [];
    private object $pedidoRepository;
    private object $produtoRepository;
    private object $categoriaRepository;
    private array $dadosRequest = [];

    public const ACAO_GET = ['listar'];
    public const ACAO_DELETE = ['deletar'];
    public const ACAO_POST = ['cadastrar'];
    public const ACAO_PUT = ['atualizar'];
    
    /**
     * __construct
     *
     * @param  mixed $dados
     * @return void
     */
    public function __construct($dados = []){
        $this->dados = $dados;
        $this->produtoRepository = new ProdutoRepository();
        $this->categoriaRepository = new CategoriaRepository();
        $this->pedidoRepository = new PedidoRepository();
    }
    
    /**
     * validarGet
     *
     * @return void
     */
    public function validarGet($rota){
        $retorno = null;
        $recurso = $this->dados['acao'];
        if(in_array($recurso, self::ACAO_GET, true)){            
            $retorno = $this->dados['id'] > 0 ? $this->getById($rota) : $this->$recurso($rota);            
        }else{
            throw new InvalidArgumentException(Constantes::MSG_ERRO_RECURSO_INEXISTENTE);
        }

        $this->validarRetornoRequest($retorno);

        return $retorno;
    }
    
    /**
     * validarDelete
     *
     * @return void
     */
    public function validarDelete($rota){
        $retorno = null;
        $recurso = $this->dados['acao'];
        if(in_array($recurso, self::ACAO_DELETE, true)){            
            if($this->dados['id'] > 0){
                $retorno = $this->$recurso($rota);
            }else{
                throw new InvalidArgumentException(Constantes::MSG_ERRO_ID_OBRIGATORIO);
            }          
        }else{
            throw new InvalidArgumentException(Constantes::MSG_ERRO_RECURSO_INEXISTENTE);
        }

        $this->validarRetornoRequest($retorno);

        return $retorno;
    }
    
    /**
     * validarPost
     *
     * @return void
     */
    public function validarPost($rota){
        $retorno = null;
        $recurso = $this->dados['acao'];
        if(in_array($recurso, self::ACAO_POST, true)){            
               $retorno = $this->$recurso($rota);
        }else{
            throw new InvalidArgumentException(Constantes::MSG_ERRO_RECURSO_INEXISTENTE);
        }
        
        $this->validarRetornoRequest($retorno);

        return $retorno;
    }
    
    /**
     * validarPut
     *
     * @return void
     */
    public function validarPut($rota){
        $retorno = null;
        $recurso = $this->dados['acao'];
        if(in_array($recurso, self::ACAO_PUT, true)){            
            if($this->dados['id'] > 0){
                $retorno = $this->$recurso($rota);
            }else{
                throw new InvalidArgumentException(Constantes::MSG_ERRO_ID_OBRIGATORIO);
            }          
        }else{
            throw new InvalidArgumentException(Constantes::MSG_ERRO_RECURSO_INEXISTENTE);
        }

        $this->validarRetornoRequest($retorno);

        return $retorno;
    }
    
    /**
     * setDadosCorpoRequest
     *
     * @param  mixed $dadosRequest
     * @return void
     */
    public function setDadosCorpoRequest($dadosRequest){
        $this->dadosRequest = $dadosRequest;
    }
    
    /**
     * getById
     *
     * @return void
     */
    private function getById($rota){    
        if($rota == 'PEDIDO'){
            return $this->pedidoRepository->getOneByKey($this->dados['id']);            
        }else{
            return $this->produtoRepository->getPostgre()->getOneByKey(Constantes::TABELA_ROTA[$rota], $this->dados['id']);
        }        
    }
    
    /**
     * listar
     *
     * @return void
     */
    private function listar($rota){
        if($rota == 'PEDIDO'){
            return $this->pedidoRepository->getAll();
        }else{
            return $this->produtoRepository->getPostgre()->getAll(Constantes::TABELA_ROTA[$rota]);
        }
        
    }
    
    /**
     * deletar
     *
     * @return void
     */
    private function deletar($rota){
        return $this->produtoRepository->getPostgre()->delete(Constantes::TABELA_ROTA[$rota], $this->dados['id']);
    }
    
    /**
     * cadastrar
     *
     * @return void
     */
    private function cadastrar($rota){        

        if($rota == 'PRODUTO'){
            $nome = $this->dadosRequest['nome'];
            $preco = $this->dadosRequest['preco'];
            $categoria = $this->dadosRequest['categoria'];
            
            if($nome && $preco && $categoria){
                if($this->produtoRepository->insertProduto($nome,$preco,$categoria) > 0){
                    $idInserido = $this->produtoRepository->getPostgre()->getDB()->lastInsertId();
                    $this->produtoRepository->getPostgre()->getDB()->commit();

                    return ['id' => $idInserido];
                }

                $this->produtoRepository->getPostgre()->getDB()->rollBack();

                throw new InvalidArgumentException(Constantes::MSG_ERRO_GENERICO_DEPENDENCIA);
            }

            throw new InvalidArgumentException(Constantes::MSG_ERRO_CAMPOS_OBRIGATORIO);
        }else if($rota == 'CATEGORIA'){
            $nome = $this->dadosRequest['nome'];
            $imposto = $this->dadosRequest['imposto'];

            if($nome && $imposto){
                if($this->categoriaRepository->insertCategoria($nome,$imposto) > 0){
                    $idInserido = $this->categoriaRepository->getPostgre()->getDB()->lastInsertId();
                    $this->categoriaRepository->getPostgre()->getDB()->commit();

                    return ['id' => $idInserido];
                }

                $this->produtoRepository->getPostgre()->getDB()->rollBack();

                throw new InvalidArgumentException(Constantes::MSG_ERRO_GENERICO);
            }

            throw new InvalidArgumentException(Constantes::MSG_ERRO_CAMPOS_OBRIGATORIO);
        }else if($rota == 'PEDIDO'){
            $valorBruto = $this->dadosRequest['valor_bruto'];
            $valorLiquido = $this->dadosRequest['valor_liquido'];
            $impostoTotal = $this->dadosRequest['imposto_total'];
            $itens = $this->dadosRequest['itens'];

            if($valorBruto && $valorLiquido && $impostoTotal && $itens){
                if($this->pedidoRepository->insertPedido($valorBruto,$valorLiquido,$impostoTotal,$itens) > 0){
                    $idInserido = $this->pedidoRepository->getPostgre()->getDB()->lastInsertId();
                    $this->pedidoRepository->getPostgre()->getDB()->commit();

                    return ['id' => $idInserido];
                }

                $this->produtoRepository->getPostgre()->getDB()->rollBack();

                throw new InvalidArgumentException(Constantes::MSG_ERRO_GENERICO);
            }

            throw new InvalidArgumentException(Constantes::MSG_ERRO_CAMPOS_OBRIGATORIO);
        }
        
    }
    
    /**
     * atualizar
     *
     * @return void
     */
    private function atualizar($rota){
        if($rota == 'PRODUTO'){
            if($this->produtoRepository->updateProduto($this->dados['id'],$this->dadosRequest) > 0){
                $this->produtoRepository->getPostgre()->getDB()->commit();
                return Constantes::MSG_ATUALIZADO_SUCESSO;
            }
    
            $this->produtoRepository->getPostgre()->getDB()->rollBack();
            throw new InvalidArgumentException(Constantes::MSG_ERRO_NAO_AFETADO);
        }else if($rota == 'CATEGORIA'){
            if($this->categoriaRepository->updateCategoria($this->dados['id'],$this->dadosRequest) > 0){
                $this->categoriaRepository->getPostgre()->getDB()->commit();
                return Constantes::MSG_ATUALIZADO_SUCESSO;
            }
    
            $this->categoriaRepository->getPostgre()->getDB()->rollBack();
            throw new InvalidArgumentException(Constantes::MSG_ERRO_NAO_AFETADO);
        }        
    }
    
    /**
     * validarRetornoRequest
     *
     * @param  mixed $retorno
     * @return void
     */
    private function validarRetornoRequest($retorno){
        if($retorno === null){
            throw new InvalidArgumentException(Constantes::MSG_ERRO_GENERICO);
        }
    }

}

?>