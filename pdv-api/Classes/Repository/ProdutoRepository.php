<?php
namespace Repository;

use DateTime;
use DB\PostgreSQL;

class ProdutoRepository{

    private object $postgre;
    private const TABELA  = 'produto';
    
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
    public function insertProduto($nome,$preco,$categoria){
        $consultaInsert = 'INSERT INTO '.self::TABELA.' (prod_nome, prod_preco, prod_categoria, created_at, updated_at) 
            VALUES (:nome, :preco, :categoria, :created_at, :updated_at)';
        $this->postgre->getDB()->beginTransaction();

        $stmt = $this->postgre->getDB()->prepare($consultaInsert);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':categoria', $categoria);
        $stmt->bindParam(':created_at', date('Y-m-d'));
        $stmt->bindParam(':updated_at', date('Y-m-d'));
        $stmt->execute();
        
        return $stmt->rowCount();
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

