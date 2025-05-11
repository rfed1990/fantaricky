<?php
header('Content-Type: application/json');
require_once 'todo.php';

$todo = new Todo();
$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    try {
        switch ($action) {
            case 'add':
                $task = $_POST['task'] ?? '';
                $description = $_POST['description'] ?? '';
                if (empty($task)) {
                    throw new Exception('Task cannot be empty');
                }
                $todo->addTask($task, $description);
                $response['success'] = true;
                $response['message'] = 'Task added successfully';
                break;

            case 'update':
                $id = $_POST['id'] ?? '';
                $status = $_POST['status'] ?? '';
                if (empty($id) || !in_array($status, ['pending', 'completed'])) {
                    throw new Exception('Invalid update parameters');
                }
                $todo->updateTaskStatus($id, $status);
                $response['success'] = true;
                $response['message'] = 'Task updated successfully';
                break;

            case 'delete':
                $id = $_POST['id'] ?? '';
                if (empty($id)) {
                    throw new Exception('Invalid task ID');
                }
                $todo->deleteTask($id);
                $response['success'] = true;
                $response['message'] = 'Task deleted successfully';
                break;

            default:
                throw new Exception('Invalid action');
        }
    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
    }
}

echo json_encode($response);