<?php
    require_once 'Conexao.php';

    class itemPedidoDAO {
        public function getItensPedido() {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM item_pedido;";

            $stmt = $conexao->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function createItemPedido(itemPedidoModel $itemPedido) {
            $conexao = (new Conexao())->getConexao();

            $sql = "INSERT INTO item_pedido VALUES(:id, :idPedido, :idProduto, :quantidade);";

            $stmt = $conexao->prepare($sql);

            $stmt->bindValue(':id', null);
            $stmt->bindValue(':idProduto', $itemPedido->idProduto);
            $stmt->bindValue(':idPedido', $itemPedido->idPedido);
            $stmt->bindValue(':quantidade', $itemPedido->quantidade);

            return $stmt->execute();
        }

        public function updateItemPedido(itemPedidoModel $itemPedido) {
            $conexao = (new Conexao())->getConexao();

            $sql = "UPDATE item_pedido set idPedido = :idPedido, idProduto = :idProduto, quantidade = :quantidade; WHERE idItemPedido = :id";
            
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':idPedido', $itemPedido->idPedido);
            $stmt->bindValue(':idProduto', $itemPedido->idProduto);
            $stmt->bindValue(':quantidade', $itemPedido->quantidade);
            $stmt->bindValue(':id', $itemPedido->idItemPedido);

            return $stmt->execute();
        }

        public function deleteitemPedido(itemPedidoModel $itemPedido) {
            $conexao = (new Conexao())->getConexao();

            $sql = "DELETE FROM item_pedido WHERE idNoticia = :id;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $itemPedido->idItemPedido);

            return $stmt->execute();
        }
    }
?>