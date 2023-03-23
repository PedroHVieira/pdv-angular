<?php

namespace DB;

use Exception;
use InvalidArgumentException;
use PDO;
use PDOException;
use Util\Constantes;

class PostgreSQL
{
    private object $db;

    /**
     * MySQL constructor.
     */
    public function __construct()
    {
        $this->db = $this->setDB();
    }

    /**
     * @return PDO
     */
    public function setDB()
    {
        try {
            $dsn = "pgsql:host=".HOST.";port=".PORTA.";dbname=".BANCO;            

            return new PDO($dsn, USER, SENHA);

        } catch (PDOException $exception) {
            throw new PDOException($exception->getMessage());
        }
    }

    /**
     * @param $tabela
     * @param $id
     * @return string
     */
    public function delete($tabela, $id)
    {
        try{
            $consultaDelete = 'DELETE FROM ' . $tabela . ' WHERE '.Constantes::PREFIX_TABLE[$tabela].'id = :id';
                        
            if ($tabela && $id) {
                $this->db->beginTransaction();
                $stmt = $this->db->prepare($consultaDelete);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    $this->db->commit();
                    return Constantes::MSG_DELETADO_SUCESSO;
                }
                $this->db->rollBack();
                throw new InvalidArgumentException(Constantes::MSG_ERRO_SEM_RETORNO);
            }
            throw new InvalidArgumentException(Constantes::MSG_ERRO_GENERICO);
        }catch(Exception $e){
            throw new InvalidArgumentException($e->getMessage());
        }
        
    }

    /**
     * @param $tabela
     * @return array
     */
    public function getAll($tabela)
    {
        if ($tabela) {
            $consulta = 'SELECT * FROM ' . $tabela;
            $stmt = $this->db->query($consulta);
            $registros = $stmt->fetchAll($this->db::FETCH_ASSOC);
            if (is_array($registros) && count($registros) > 0) {
                return $registros;
            }
        }
        
        throw new InvalidArgumentException(Constantes::MSG_ERRO_SEM_RETORNO);
    }

    /**
     * @param $tabela
     * @param $id
     * @return mixed
     */
    public function getOneByKey($tabela, $id)
    {
        if ($tabela && $id) {
            $consulta = 'SELECT * FROM ' . $tabela . ' WHERE '.Constantes::PREFIX_TABLE[$tabela].'id = :id';

            $stmt = $this->db->prepare($consulta);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $totalRegistros = $stmt->rowCount();
            if ($totalRegistros === 1) {
                return $stmt->fetch($this->db::FETCH_ASSOC);
            }
            throw new InvalidArgumentException(Constantes::MSG_ERRO_SEM_RETORNO);
        }

        throw new InvalidArgumentException(Constantes::MSG_ERRO_ID_OBRIGATORIO);
    }

    /**
     * @return object|PDO
     */
    public function getDB()
    {
        return $this->db;
    }
}