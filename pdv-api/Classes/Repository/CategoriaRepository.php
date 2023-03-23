<?php
namespace Repository;

use DateTime;
use DB\PostgreSQL;

class CategoriaRepository{

    private object $postgre;
    private const TABELA  = 'categoria';
    
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
    public function insertCategoria($nome,$imposto){
        $consultaInsert = 'INSERT INTO '.self::TABELA.' (cate_nome, cate_imposto, created_at, updated_at) 
            VALUES (:nome, :imposto, :created_at, :updated_at)';
        $this->postgre->getDB()->beginTransaction();

        $stmt = $this->postgre->getDB()->prepare($consultaInsert);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':imposto', $imposto);        
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
    public function updateCategoria($id, $dados){
        $consultaUpdate = 'UPDATE '.self::TABELA.' SET cate_nome = :nome, cate_imposto = :imposto, updated_at = :updated_at WHERE cate_id = :id';
        $this->postgre->getDB()->beginTransaction();

        $stmt = $this->postgre->getDB()->prepare($consultaUpdate);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $dados['nome']);
        $stmt->bindParam(':imposto', floatval($dados['imposto']));            
        $stmt->bindParam(':updated_at', date('Y-m-d'));
        $stmt->execute();
       
        return $stmt->rowCount();
    }

}

?>

