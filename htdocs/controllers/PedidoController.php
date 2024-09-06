<?php
    require_once './models/PedidoModel.php';

    class PedidoController {
        public function getPedidos(int $idUsuario, int $idStatus) {
            $pedidoModel = new PedidoModel();

            $pedidos = $pedidoModel->getPedidos();

            return json_encode([
                'error' => null,
                'result' => $pedidos
            ]);
        }

        public function createPedido() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['idUsuario']))
                return $this->mostrarErro('Você deve informar o id do usuario');

            if (empty($dados['idStatus']))
                return $this->mostrarErro('Você deve informar o id do!');
        
            $pedido = new PedidoModel(
                null,
                $dados['idUsuario'],
                $dados['idStatus'],
            );

            $pedido->create();

            return json_encode([
                'error' => null,
                'result' => true
            ]);
        }

        public function updatePedidoStatus() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['idPedido']))
                return $this->mostrarErro('voce deve informar o id do pedido');

            if (empty($dados['idStatus']))
                return $this->mostrarErro('Você deve informar o nomeUsuario!');
        
            $usuario = new PedidoModel(
                $dados['idPedido'],
                $dados['idStatus']
            );

            $usuario->update();

            return json_encode([
                'error' => null,
                'result' => true
            ]);
        }

        public function deletePedido() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['idPedido']))
                return $this->mostrarErro('Você deve informar o id pedido');

            $pedido = new PedidoModel($dados['idPedido']);

            $pedido->delete();

            return json_encode([
                'error' => null,
                'result' => true
            ]);
        }

        public function getPedido() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['idPedido']))
                return $this->mostrarErro('Você deve informar o id do pedido');

            $response = (new PedidoModel())->getPedido($dados['idPedido']);

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }

        public function getPedidosPessoa() {
            $dados = json_decode(file_get_contents("php://input"), true);

            if (empty($dados['idUsuario']))
                return $this->mostrarErro('Você deve informar o ID do Usuario');

            $response = (new PedidoModel())->getPedidosPessoa($dados['idUsuario']);

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }

        public function getValorTotal() {
            $dados = json_decode(file_get_contents("php://input"), true);

            if (empty($dados['idPedido']))
                return $this->mostrarErro('Você deve informar o ID do Pedido');

            $response = (new PedidoModel())->getValorTotal($dados['idPedido']);

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }

        private function mostrarErro(string $mensagem) {
            return json_encode([
                'error' => $mensagem,
                'result' => null
            ]);
        }
    }
?>