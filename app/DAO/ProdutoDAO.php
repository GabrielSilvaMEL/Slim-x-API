<?php
namespace App\DAO;

class ProdutoDAO{
    /** @var string */
    protected $table;

    /** @var \PDO */
    protected $db;

    public function __construct($db){
        $this->table = "produtos";
        $this->db = $db;
    }

    public function listar_todos(){
        $dados = null;
        $sql  = "SELECT * FROM {$this->table}";

        $result = $this->db->prepare($sql);
        $result->execute();

        if ($result->rowCount() > 0) {
            $dados = $result->fetchAll(\PDO::FETCH_OBJ);
        }

        return $dados;
    }

    public function buscar_por_id($prod_id){
    }

    public function cadastrar($dados){
        $sql = "INSERT INTO {$this->table}(prod_nome,prod_marca,prod_fornecedor,prod_estoque)
                VALUES(:prod_nome,:prod_marca,:prod_fornecedor, :prod_estoque)";
        $result = $this->db->prepare($sql);
        $result->bindValue(':prod_nome',$dados->prod_nome);
        $result->bindValue(':prod_marca',$dados->prod_marca);
        $result->bindValue(':prod_fornecedor',$dados->prod_fornecedor);
        $result->bindValue(':prod_estoque',$dados->prod_estoque);

        $result->execute();
    }

    public function atualizar($dados){
    }

    public function remover($prod_id){
    }
}
