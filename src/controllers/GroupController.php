<?php

class GroupController {
    private $pdo;

    public function __construct($config) {
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['dbname'];
        $this->pdo = new PDO($dsn, $config['db']['user'], $config['db']['password']);
    }

    public function list() {
        $stmt = $this->pdo->prepare("SELECT * FROM groups");
        $stmt->execute();

        $groups = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode(['groups' => $groups]);
    }
}
