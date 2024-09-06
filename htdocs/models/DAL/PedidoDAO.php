<?php
    require_once 'Conexao.php';

    class PedidoDAO {
        public function getPedidos() {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM pedido;";

            $stmt = $conexao->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function createPedido(PedidoModel $pedido) {
            $conexao = (new Conexao())->getConexao();

            $sql = "INSERT INTO pedido VALUES (:id, :idUsuario, :idStatus);";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', null);
            $stmt->bindValue(':idUsuario', $pedido->idUsuario);
            $stmt->bindValue(':idStatus', $pedido->idStatus);

            return $stmt->execute();
        }

        public function updatePedidoStatus(PedidoModel $pedido) {
            $conexao = (new Conexao())->getConexao();

            $sql = "UPDATE pedido SET idStatus = :status WHERE idPedido = :id;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $pedido->idPedido);
            $stmt->bindValue(':status', $pedido->idStatus);

            return $stmt->execute();
        }

        public function deletePedido(PedidoModel $pedido) {
            $conexao = (new Conexao())->getConexao();

            $sql = "DELETE FROM pedido WHERE idPedido = :id";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $pedido->idPedido);

            return $stmt->execute();
        }

        public function getPedido($idPedido) {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM pedido WHERE idPedido = :id;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $idPedido);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function getPedidosPessoa($idUsuario) {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM pedido WHERE idUsuario = :id;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $idUsuario);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getValorTotal($idPedido) {
            $conexao = (new Conexao())->getConexao();
    
            $sql = "SELECT SUM(p.precoProduto * ip.quantidade) AS precoTotal FROM item_pedido ip INNER JOIN produto p ON p.idProduto = ip.idProduto WHERE ip.idPedido = :id GROUP BY ip.idPedido;";
    
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $idPedido);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result['precoTotal'] : 0;
        }
    }
?>