<?php
    require_once './models/UsuarioModel.php';

    class UsuarioController {
        public function getUsuarios() {
            $usuarioModel = new UsuarioModel();

            $usuarios = $usuarioModel->getUsuarios();

            return json_encode([
                'error' => null,
                'result' => $usuarios
            ]);
        }

        public function createUsuario() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['nomeUsuario']))
                return $this->mostrarErro('Você deve informar o nomeUsuario!');

            if (empty($dados['cpfUsuario']))
                return $this->mostrarErro('Você deve informar o cpfUsuario!');

            if (empty($dados['senhaUsuario']))
                return $this->mostrarErro('Você deve informar o senhaUsuario!');
        
            $usuario = new UsuarioModel(
                null,
                $dados['nomeUsuario'],
                $dados['cpfUsuario'],
                md5($dados['senhaUsuario'])
            );

            $usuario->create();

            return json_encode([
                'error' => null,
                'result' => true
            ]);
        }

        public function updateUsuario() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['idUsuario']))
                return $this->mostrarErro('Você deve informar o idUsuario!');

            if (empty($dados['nomeUsuario']))
                return $this->mostrarErro('Você deve informar o nomeUsuario!');

            if (empty($dados['cpfUsuario']))
                return $this->mostrarErro('Você deve informar o emailUsuario!');

            if (empty($dados['senhaUsuario']))
                return $this->mostrarErro('Você deve informar o senhaUsuario!');
        
            $usuario = new UsuarioModel(
                $dados['idUsuario'],
                $dados['nomeUsuario'],
                $dados['cpfUsuario'],
                md5($dados['senhaUsuario'])
            );

            $usuario->update();

            return json_encode([
                'error' => null,
                'result' => true
            ]);
        }

        public function deleteUsuario() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['idUsuario']))
                return $this->mostrarErro('Você deve informar o idUsuario');

            $usuario = new UsuarioModel($dados['idUsuario']);

            $usuario->delete();

            return json_encode([
                'error' => null,
                'result' => true
            ]);
        }

        public function getUsuario() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['idUsuario']))
                return $this->mostrarErro('Você deve informar o idUsuario!');

            $response = (new UsuarioModel())->getUsuario($dados['idUsuario']);

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }

        public function validateCpf() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['cpf']))
                return $this->mostrarErro('Você deve informar o cpf!');

            $usuario = (new UsuarioModel())->getUsuarioByCpf($dados['cpf']);

            $response = empty($usuario) ? true : false;

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }

        public function validateUsuario() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['cpf']))
                return $this->mostrarErro('Você deve informar o cpf!');

            if (empty($dados['senha']))
                return $this->mostrarErro('Você deve informar a senha!');

            $usuario = (new UsuarioModel())->getUsuarioByCpfAndSenha($dados['cpf'], md5($dados['senha']));

            $response = empty($usuario) ? false : true;

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