<?php
    require_once './models/ProdutoModel.php';
    
    class ProdutoController {
        public function getProdutos() {
            $produtoModel = new ProdutoModel();

            $response = $produtoModel->getProdutos();

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }

        public function createProduto() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['descricaoProduto']))
                return $this->mostrarErro('Você deve informar a descricao do produto!');
            
            if (empty($dados['precoProduto']))
                return $this->mostrarErro('voce deve informar o preco do produto');

            $produto = new ProdutoModel(null, $dados['descricaoProduto'], $dados['precoProduto']);

            $response = $produto->create();

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }

        public function updateProduto() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['idProduto'])) 
                return $this->mostrarErro('Você deve informar o idProduto!');

            if (empty($dados['descricaoProduto']))
                return $this->mostrarErro('Você deve informar a descricao do produto!');

            if (empty($dados['precoProduto']))
                return $this->mostrarErro('voce deve informar o preco do produto');

            $produto = new ProdutoModel($dados['idProduto'], $dados['descricaoProduto'], $dados['precoProduto']);

            $response = $produto->update();

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }

        public function deleteProduto() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['idProduto']))
                return $this->mostrarErro('Você deve informar o idProduto!');

            $produto = new ProdutoModel($dados['idProduto']);

            $response = $produto->delete();

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }

        public function getProduto() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['idProduto']))
                return $this->mostrarErro('Você deve informar o idProduto!');

            $response = (new ProdutoModel())->getProduto($dados['idProduto']);

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