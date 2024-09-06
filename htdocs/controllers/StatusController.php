<?php
    require_once './models/StatusModel.php';

    class StatusController {
        public function getStatus() {
            $StatusModel = new StatusModel();

            $status  = $StatusModel->getStatus();

            return json_encode([
                'error' => null,
                'result' => $status
            ]);
        }

        public function getStatusById() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['idStatus']))
            return $this->showError('Você deve informar o ID Status');

            $response = (new StatusModel())->getStatusById($dados['idStatus']);

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