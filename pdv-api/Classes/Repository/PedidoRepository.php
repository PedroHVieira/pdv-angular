<?php
namespace Repository;

use DateTime;
use DB\PostgreSQL;
use InvalidArgumentException;
use Util\Constantes;

class PedidoRepository{

    private object $postgre;
    private const TABELA  = 'pedido';
    private const TABELA_ITEM  = 'pedido_item';
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(){
        $this->postgre = new PostgreSQL();        
    }
    
    /**
     * getPostgre
     *
     * @return void
     */
    public function getPostgre(){
        return $this->postgre;
    }
        
    /**
     * insertProduto
     *
     * @param  mixed $nome
     * @param  mixed $preco
     * @param  mixed $categoria
     * @return void
     */
    public function insertPedido($valorBruto,$valorLiquido,$impostoTotal,$itens){
        $consultaInsert = 'INSERT INTO '.self::TABELA.' (pedi_valo_bruto, pedi_valor_liquido, pedi_valor_imposto, created_at, updated_at) 
            VALUES (:valor_bruto, :valor_liquido, :valor_imposto, :created_at, :updated_at)';
        $this->postgre->getDB()->beginTransaction();

        $stmt = $this->postgre->getDB()->prepare($consultaInsert);
        $stmt->bindParam(':valor_bruto', $valorBruto);
        $stmt->bindParam(':valor_liquido', $valorLiquido);
        $stmt->bindParam(':valor_imposto', $impostoTotal);
        $stmt->bindParam(':created_at', date('Y-m-d'));
        $stmt->bindParam(':updated_at', date('Y-m-d'));
        $stmt->execute();

        if($stmt->rowCount() <= 0){
            $this->postgre->getDB()->rollBack();
            throw new InvalidArgumentException(Constantes::MSG_ERRO_GENERICO);
        }

        $idInserido = $this->postgre->getDB()->lastInsertId();

        for($i = 0; $i < count($itens); $i++){
            $consultaInserItens = 'INSERT INTO '.self::TABELA_ITEM.'(pdit_qtd, pdit_valor_bruto, pdit_valor_liquido, pdit_valor_imposto, created_at, updated_at, pdit_produto, pdit_pedido) 
            VALUES (:qtd, :bruto, :liquido, :imposto, :created, :updated, :produto, :pedido)';

            $stmt = $this->postgre->getDB()->prepare($consultaInserItens);
            $stmt->bindParam(':qtd', $itens[$i]['qtd']);
            $stmt->bindParam(':bruto', $itens[$i]['bruto']);
            $stmt->bindParam(':liquido', $itens[$i]['liquido']);
            $stmt->bindParam(':imposto', $itens[$i]['imposto']);
            $stmt->bindParam(':produto', $itens[$i]['produto']);
            $stmt->bindParam(':pedido', $idInserido);
            $stmt->bindParam(':created', date('Y-m-d'));
            $stmt->bindParam(':updated', date('Y-m-d'));
            $stmt->execute();

            if($stmt->rowCount() <= 0){
                $this->postgre->getDB()->rollBack();
                throw new InvalidArgumentException(Constantes::MSG_ERRO_GENERICO);
            }
        }
        
        return $stmt->rowCount();
    }
        
    /**
     * getAll
     *
     * @return void
     */
    public function getAll(){
        $consulta = "SELECT * FROM ".self::TABELA;
        $this->postgre->getDB()->beginTransaction();        
        $stmt = $this->postgre->getDB()->prepare($consulta);
        $stmt = $this->postgre->getDB()->query($consulta);
        $pedido = $stmt->fetchAll($this->postgre->getDB()::FETCH_ASSOC);
        
        for($i = 0; $i < count($pedido); $i++){
            $consultaItensPedido = "SELECT * FROM ".self::TABELA_ITEM." WHERE pdit_pedido = ".$pedido[$i]['pedi_id'];             
            $stmt = $this->postgre->getDB()->prepare($consultaItensPedido);
            $stmt = $this->postgre->getDB()->query($consultaItensPedido);
            $itens = $stmt->fetchAll($this->postgre->getDB()::FETCH_ASSOC);           
            
            $pedido[$i]['itens'] = $itens;
        }
        
        return $pedido;
    }
    
    /**
     * getOneByKey
     *
     * @param  mixed $id
     * @return void
     */
    public function getOneByKey($id){
        $consulta = "SELECT * FROM ".self::TABELA." WHERE pedi_id = ".$id;
        $this->postgre->getDB()->beginTransaction();        
        $stmt = $this->postgre->getDB()->prepare($consulta);
        $stmt = $this->postgre->getDB()->query($consulta);
        $pedido = $stmt->fetch($this->postgre->getDB()::FETCH_ASSOC);
        
        $consultaItensPedido = "SELECT * FROM ".self::TABELA_ITEM." WHERE pdit_pedido = ".$pedido['pedi_id'];             
        $stmt = $this->postgre->getDB()->prepare($consultaItensPedido);
        $stmt = $this->postgre->getDB()->query($consultaItensPedido);
        $itens = $stmt->fetchAll($this->postgre->getDB()::FETCH_ASSOC);           
        
        $pedido['itens'] = $itens;        
        
        return $pedido;
    }
    
    /**
     * updateProduto
     *
     * @param  mixed $id
     * @param  mixed $dados
     * @return void
     */
    public function updateProduto($id, $dados){
        $consultaUpdate = 'UPDATE '.self::TABELA.' SET prod_nome = :nome, prod_preco = :preco, prod_categoria = :categoria, updated_at = :updated_at WHERE prod_id = :id';
        $this->postgre->getDB()->beginTransaction();

        $stmt = $this->postgre->getDB()->prepare($consultaUpdate);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $dados['nome']);
        $stmt->bindParam(':preco', floatval($dados['preco']));
        $stmt->bindParam(':categoria', intval($dados['categoria']));        
        $stmt->bindParam(':updated_at', date('Y-m-d'));
        $stmt->execute();
       
        return $stmt->rowCount();
    }

}

?>

