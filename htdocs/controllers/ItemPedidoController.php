<?php
    require_once './models/itemPedidoModel.php';

    class itemPedidoController {

        public function getItensPedido() {
            $itemPedidoModel = new itemPedidoModel();

            $response = $itemPedidoModel->getItensPedido();

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }

        public function createItemPedido() {
            $dados = json_decode(file_get_contents("php://input"), true);

            if (empty($dados['idProduto']))
                return $this->showError('Você deve informar o ID do Produto');
        
            if (empty($dados['idPedido']))
                return $this->showError('Você deve informar o ID do Pedido');

            if (empty($dados['quantidade']))
                return $this->showError('Você deve informar a Quantidade do Produto');

            $itemPedido = new itemPedidoModel(
                null,
                $dados['idProduto'],
                $dados['idPedido'],
                $dados['quantidade']
            );

            $response = $itemPedido->create();

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }

        public function updateItemPedido() {
            $dados = json_decode(file_get_contents("php://input"), true);

            if (empty($dados['idItemPedido']))
                return $this->showError('Você deve informar o ID Item-Pedido');

            if (empty($dados['idProduto']))
                return $this->showError('Você deve informar o ID do Produto');
        
            if (empty($dados['idPedido']))
                return $this->showError('Você deve informar o ID do Pedido');

            if (empty($dados['quantidade']))
                return $this->showError('Você deve informar a Quantidade do Produto');

            $itemPedido = new itemPedidoModel(
                $dados['idItemPedido'],
                $dados['idProduto'],
                $dados['idPedido'],
                $dados['quantidade']
            );

            $response = $itemPedido->update();

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }

        public function deleteitemPedido() {
            $dados = json_decode(file_get_contents("php://input"), true);

            if (empty($dados['idItemPedido']))
                return $this->showError('Você deve informar o ID Item-Produto');

            $itemPedido = new itemPedidoModel($dados['idItemPedido']);
            
            $response = $itemPedido->delete();

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }

        private function showError(string $msg) {
            return json_encode([
                'error' => $msg,
                'result' => null
            ]);
        }

    }
?>