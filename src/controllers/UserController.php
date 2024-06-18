<?php

class UserController {
    private $pdo;

    public function __construct($config) {
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['dbname'];
        $this->pdo = new PDO($dsn, $config['db']['user'], $config['db']['password']);
    }

    public function addToGroup() {
        $userId = $_POST['user_id'];
        $groupId = $_POST['group_id'];

        $stmt = $this->pdo->prepare("INSERT INTO user_groups (user_id, group_id) VALUES (:user_id, :group_id)");
        $stmt->execute(['user_id' => $userId, 'group_id' => $groupId]);

        echo json_encode(['status' => 'success']);
    }

    public function removeFromGroup() {
        $userId = $_POST['user_id'];
        $groupId = $_POST['group_id'];

        $stmt = $this->pdo->prepare("DELETE FROM user_groups WHERE user_id = :user_id AND group_id = :group_id");
        $stmt->execute(['user_id' => $userId, 'group_id' => $groupId]);

        echo json_encode(['status' => 'success']);
    }

    public function permissions() {
        $userId = $_GET['user_id'];

        $stmt = $this->pdo->prepare("
            SELECT p.name 
            FROM permissions p
            JOIN group_permissions gp ON p.id = gp.permission_id
            JOIN user_groups ug ON gp.group_id = ug.group_id
            WHERE ug.user_id = :user_id
            UNION
            SELECT p.name
            FROM permissions p
            WHERE p.id NOT IN (
                SELECT permission_id
                FROM user_temporarily_blocked
                WHERE user_id = :user_id
            )
        ");
        $stmt->execute(['user_id' => $userId]);

        $permissions = $stmt->fetchAll(PDO::FETCH_COLUMN);

        echo json_encode(['permissions' => $permissions]);
    }
}
