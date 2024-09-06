<?php
    require_once 'DAL/itemPedidoDAO.php';

    class itemPedidoModel {
        public ?int $idItemPedido;
        public ?int $idProduto;
        public ?int $idPedido;
        public ?string $quantidade;

        public function __construct(
            ?int $idItemPedido = null,
            ?int $idProduto = null,
            ?int $idPedido = null,
            ?string $quantidade = null
        ) {
            $this->idItemPedido = $idItemPedido;
            $this->idProduto = $idProduto;
            $this->idPedido = $idPedido;
            $this->quantidade = $quantidade;
        }

        public function getItensPedido() {
            $itemPedidoDAO = new itemPedidoDAO();

            $itensProduto = $itemPedidoDAO->getItensPedido();

            foreach ($itensProduto as $chave => $itemPedido) {
                $itensProduto[$chave] = new itemPedidoModel(
                    $itemPedido['idItemPedido'],
                    $itemPedido['idProduto'],
                    $itemPedido['idPedido'],
                    $itemPedido['quantidade']
                );
            }

            return $itensProduto;
        }

        public function create() {
            $itemPedidoDAO = new itemPedidoDAO();

            return $itemPedidoDAO->createItemPedido($this);
        }

        public function update() {
            $itemPedidoDAO = new itemPedidoDAO();

            return $itemPedidoDAO->updateItemPedido($this);
        }

        public function delete() {
            $itemPedidoDAO = new itemPedidoDAO();

            return $itemPedidoDAO->deleteitemPedido($this);
        }
    }
?>