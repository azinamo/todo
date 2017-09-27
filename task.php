<?php
require_once 'dbconf.php';
require_once 'classes/DBConn.php';
require_once 'classes/Task.php';
if (isset($_POST['action']) && !empty($_POST['action'])) {

    switch ($_POST['action']) {
        case 'save':
                $taskObj = new \Todo\Task();
                $task = $taskObj->save($_POST['data']);
                if ($task) {
                   $reponse = ['text' => 'Task saved successfully', 'error' => false, 'id' => $task];
                } else {
                    $reponse = ['text' => 'Task could not be save', 'error' => true];
                }
            break;
        case 'update':
            $taskData = $_POST['data'];
            $taskObj = new \Todo\Task();
            $task = $taskObj->updateTask($taskData['id'], $taskData);
            if ($task) {
                $reponse = ['text' => 'Task updated successfully', 'error' => false];
            } else {
                $reponse = ['text' => 'Task could not be updated', 'error' => true];
            }
            break;
        case 'update_tasks':
            $taskData = $_POST['data'];
            $taskObj = new \Todo\Task();
            $task = $taskObj->updateTasks($_POST['tasks'], $taskData);
            if ($task) {
                $reponse = ['text' => 'Task updated successfully', 'error' => false];
            } else {
                $reponse = ['text' => 'Task could not be updated', 'error' => true];
            }
            break;
        case 'delete':
            $taskObj = new \Todo\Task();
            $task = $taskObj->updateTask($_POST['id'], $_POST['data']);
            if ($task) {
                $reponse = ['text' => 'Task updated successfully', 'error' => false];
            } else {
                $reponse = ['text' => 'Task could not be save', 'error' => true];
            }
            break;
        case 'get_task':
            echo "Teting";
            exit();
            $taskObj = new \Todo\Task();
            $task = $taskObj->getTask($id);
            var_dump($task);
            exit();
            echo include_once'includes/task.php';
            die();
            break;
        case 'get_all':
            $taskObj = new \Todo\Task();
            $tasks = $taskObj->getAll();
            include_once 'includes/tasks.php';
            die();
            break;
        default:
            $reponse = ['text' => 'Action not found', 'error' => true];
            break;
    }
    echo json_encode($reponse);
  die();
}