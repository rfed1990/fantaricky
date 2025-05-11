<?php
require_once 'todo.php';
require_once 'header.php';

$todo = new Todo();
$tasks = $todo->getAllTasks();
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">Todo List</h2>
                </div>
                <div class="card-body">
                    <form id="addTaskForm" class="mb-4">
                        <div class="mb-3">
                            <input type="text" class="form-control" id="taskInput" placeholder="Enter new task" required>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" id="descriptionInput" placeholder="Task description (optional)"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Task</button>
                    </form>

                    <div id="taskList">
                        <?php foreach ($tasks as $task): ?>
                            <div class="task-item card mb-2" data-id="<?php echo htmlspecialchars($task['id']); ?>">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-1 <?php echo $task['status'] === 'completed' ? 'text-muted text-decoration-line-through' : ''; ?>">
                                            <?php echo htmlspecialchars($task['task']); ?>
                                        </h5>
                                        <p class="mb-0 text-muted"><?php echo htmlspecialchars($task['description']); ?></p>
                                    </div>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-success toggle-status">
                                            <?php echo $task['status'] === 'completed' ? 'Undo' : 'Complete'; ?>
                                        </button>
                                        <button class="btn btn-sm btn-danger delete-task">Delete</button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/todo.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const addTaskForm = document.getElementById('addTaskForm');
    const taskList = document.getElementById('taskList');

    addTaskForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const taskInput = document.getElementById('taskInput');
        const descriptionInput = document.getElementById('descriptionInput');

        fetch('todo-actions.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `action=add&task=${encodeURIComponent(taskInput.value)}&description=${encodeURIComponent(descriptionInput.value)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        });

        taskInput.value = '';
        descriptionInput.value = '';
    });

    taskList.addEventListener('click', function(e) {
        if (e.target.classList.contains('toggle-status')) {
            const taskItem = e.target.closest('.task-item');
            const taskId = taskItem.dataset.id;
            const isCompleted = e.target.textContent.trim() === 'Undo';

            fetch('todo-actions.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `action=update&id=${taskId}&status=${isCompleted ? 'pending' : 'completed'}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            });
        }

        if (e.target.classList.contains('delete-task')) {
            if (confirm('Are you sure you want to delete this task?')) {
                const taskItem = e.target.closest('.task-item');
                const taskId = taskItem.dataset.id;

                fetch('todo-actions.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `action=delete&id=${taskId}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
            }
        }
    });
});
</script>

<?php require_once 'footer.php'; ?>