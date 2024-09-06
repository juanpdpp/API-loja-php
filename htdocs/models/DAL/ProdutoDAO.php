<?php
    require_once 'Conexao.php';

    class ProdutoDAO {
        public function getProdutos() {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM produto;";

            $stmt = $conexao->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function createProduto(ProdutoModel $produto) {
            $conexao = (new Conexao())->getConexao();

            $sql = "INSERT INTO produto VALUES (:id, :descricao, :preco);";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', null);
            $stmt->bindValue(':descricao', $produto->descricaoProduto);
            $stmt->bindValue(':preco', $produto->precoProduto);

            return $stmt->execute();
        }

        public function updateProduto(ProdutoModel $produto) {
            $conexao = (new Conexao())->getConexao();

            $sql = "UPDATE produto SET descricaoProduto = :descricao, precoProduto = :preco WHERE idProduto = :id;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $produto->idProduto);
            $stmt->bindValue(':descricao', $produto->descricaoProduto);
            $stmt->bindValue(':preco', $produto->precoProduto);

            return $stmt->execute();
        }

        public function deleteProduto(ProdutoModel $produto) {
            $conexao = (new Conexao())->getConexao();

            $sql = "DELETE FROM produto WHERE idProduto = :id;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $produto->idProduto);

            return $stmt->execute();
        }

        public function getProduto($idProduto) {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM produto WHERE idProduto = :id;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $idProduto);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    } 
?>