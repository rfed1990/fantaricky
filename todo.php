<?php
require_once 'db.php';

class Todo {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function addTask($task, $description = '') {
        $sql = "INSERT INTO todos (task, description) VALUES (:task, :description)";
        $params = ['task' => $task, 'description' => $description];
        return $this->db->insert($sql, $params);
    }

    public function getAllTasks() {
        $sql = "SELECT * FROM todos ORDER BY created_at DESC";
        return $this->db->select($sql);
    }

    public function updateTaskStatus($id, $status) {
        $sql = "UPDATE todos SET status = :status WHERE id = :id";
        $params = ['id' => $id, 'status' => $status];
        return $this->db->update($sql, $params);
    }

    public function deleteTask($id) {
        $sql = "DELETE FROM todos WHERE id = :id";
        $params = ['id' => $id];
        return $this->db->delete($sql, $params);
    }

    public function getTask($id) {
        $sql = "SELECT * FROM todos WHERE id = :id";
        $params = ['id' => $id];
        return $this->db->selectOne($sql, $params);
    }
}