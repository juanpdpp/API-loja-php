<?php
    class Router {
        private array $routes;

        public function __construct() {
            $this->routes = [
                'GET' => [
                    '/usuarios' => [
                        'controller' => 'UsuarioController',
                        'function' => 'getUsuarios'
                    ],
                    '/status' => [
                        'controller' => 'StatusController',
                        'function' => 'getStatus'
                    ],
                    '/produtos' => [
                    'controller' => 'ProdutoController',
                    'function' => 'getProdutos'
                    ]
                ],
                'POST' => [
                    '/cadastrar-usuario' => [
                        'controller' => 'UsuarioController',
                        'function' => 'createUsuario'
                    ],
                    '/cadastrar-produto' => [
                        'controller' => 'ProdutoController',
                        'function' => 'createProduto'
                    ],
                    '/usuario' => [
                        'controller' => 'UsuarioController',
                        'function' => 'getUsuario'
                    ],
                    '/status-by-id' => [
                        'controller' => 'StatusController',
                        'function' => 'getStatusById' //talvev mudar esse nome
                    ],
                    '/produto' => [
                        'controller' => 'ProdutoController',
                        'function' => 'getProduto'
                    ],
                    '/pedido' => [
                        'controller' => 'PedidoController', //buscar pedido por id
                        'function' => 'getPedido'
                    ],
                    '/pedidos-pessoa' => [
                        'controller' => 'PedidoController', //buscar todos os pedidos de uma pessoa
                        'function' => 'getPedidosPessoa'
                    ],
                    '/cadastrar-pedido' => [
                        'controller' => 'PedidoController',
                        'function' => 'createPedido'
                    ],
                    '/valor-total-pedido' => [
                        'controller' => 'PedidoController', //buscar o valor total do pedido.
                        'function' => 'getValorTotal'
                    ],
                    '/itens-pedido' => [
                        'controller' => 'ItemPedidoController', //buscar todos os pedidos
                        'function' => 'getItensPedido'
                    ],
                    '/cadastrar-item-pedido' => [
                        'controller' => 'ItemPedidoController',
                        'function' => 'createItemPedido'
                    ],
                    '/login' => [
                        'controller' => 'UsuarioController',
                        'function' => 'validateUsuario'
                    ]
                ],
                'PUT' => [
                    '/editar-usuario' => [
                        'controller' => 'UsuarioController',
                        'function' => 'updateUsuario'
                    ],
                    '/editar-produto' => [
                        'controller' => 'ProdutoController',
                        'function' => 'updateProduto'
                    ],
                    '/editar-status-pedido' => [
                        'controller' => 'PedidoController',
                        'function' => 'updatePedidoStatus'
                    ]
                ],
                'DELETE' => [
                    '/excluir-usuario' => [
                        'controller' => 'UsuarioController',
                        'function' => 'deleteUsuario'
                    ],
                    '/excluir-produto' => [
                        'controller' => 'ProdutoController',
                        'function' => 'deleteProduto'
                    ],
                    '/excluir-pedido' => [
                        'controller' => 'PedidoController',
                        'function' => 'deletePedido'
                    ],
                    'excluir-item-pedido' => [
                        'controller' => 'ItemPedidoController',
                        'function' => 'deleteitemPedido'
                    ]
                ]
            ];
        }

        public function handleRequest(string $method, string $route): string {
            $routeExists = !empty($this->routes[$method][$route]);

            if (!$routeExists) {
                return json_encode([
                    'error' => 'Essa rota não existe!',
                    'result' => null
                ]);
            }

            $routeInfo = $this->routes[$method][$route];

            $controller = $routeInfo['controller'];
            $function = $routeInfo['function'];

            require_once __DIR__ . '/../controllers/' . $controller . '.php';

            return (new $controller)->$function();
        }
    }
?>