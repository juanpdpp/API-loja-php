<?php
    require_once 'DAL/ProdutoDAO.php';

    class ProdutoModel {
        public ?int $idProduto;
        public ?string $descricaoProduto;
        public ?float $precoProduto;

        public function __construct(
            ?int $idProduto = null,
            ?string $descricaoProduto = null,
            ?float $precoProduto = null
        ) {
            $this->idProduto = $idProduto;
            $this->descricaoProduto = $descricaoProduto;
            $this->precoProduto = $precoProduto;
        }

        public function getProdutos() {
            $produtoDAO = new ProdutoDAO();

            $produtos = $produtoDAO->getProdutos();

            foreach ($produtos as $chave => $produto) {
                $protudos[$chave] = new ProdutoModel(
                    $produto['idProduto'],
                    $produto['descricaoProduto'],
                    $produto['precoProduto']
                );
            }

            return $produtos;
        }

        public function create() {
            $produtoDAO = new ProdutoDAO;

            return $produtoDAO->createProduto($this);
        }

        public function update() {
            $produtoDAO = new ProdutoDAO;

            return $produtoDAO->updateProduto($this);
        }

        public function delete() {
            $produtoDAO = new ProdutoDAO;

            return $produtoDAO->deleteProduto($this);
        }

        public function getProduto($idProduto) {
            $produtoDAO = new ProdutoDAO;

            $produto = $produtoDAO->getProduto($idProduto);

            $produto = new ProdutoModel($produto['idProduto'], $produto['descricaoProduto'], $produto['precoProduto']);

            return $produto;
        }

    }
?>