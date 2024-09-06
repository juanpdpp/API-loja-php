<?php
    require_once 'DAL/StatusDAO.php';

    class StatusModel {
        public ?int $idStatus;
        public ?string $descricaoStatus;

        public function __construct(?int $idStatus = null, ?string $descricaoStatus = null) {
            $this->idStatus = $idStatus;
            $this->descricaoStatus = $descricaoStatus;
        }

        public function getStatus() {
            $StatusDAO = new StatusDAO();

            $statuzes = $StatusDAO->getStatus();

            foreach ($statuzes as &$status) {
                $status = new StatusModel($status['idStatus'], $status['descricaoStatus']);
            }

            return $statuzes;
        }

        public function getStatusById($idStatus) {
            $statusDAO = new StatusDAO();

            $status = $statusDAO->getStatusById($idStatus);

            $status = new StatusModel(
                $status['idStatus'], 
                $status['descricaoStatus']
            );

            return $status;
        }
    }
?>