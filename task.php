<?php
include_once 'classes/DBConn.php';
include_once 'classes/Model.php';
include_once 'classes/Task.php';
if (isset($_POST['action']) && !empty($_POST['action'])) {

    switch ($_POST['action']) {
        case 'save':
                $taskObj = new \Todo\Task();
                $task = $taskObj->save($_POST['task']);
                if ($task) {
                   $reponse = ['text' => 'Task saved successfully', 'error' => false];
                } else {
                    $reponse = ['text' => 'Task could not be save', 'error' => true];
                }
            break;
        case 'update':
            $taskObj = new \Todo\Task();
            $task = $taskObj->update($_POST['id'], $_POST['task']);
            if ($task) {
                $reponse = ['text' => 'Task updated successfully', 'error' => false];
            } else {
                $reponse = ['text' => 'Task could not be save', 'error' => true];
            }
            break;
        case 'delete':
            $taskObj = new \Todo\Task();
            $task = $taskObj->update($_POST['id'], $_POST['task']);
            if ($task) {
                $reponse = ['text' => 'Task updated successfully', 'error' => false];
            } else {
                $reponse = ['text' => 'Task could not be save', 'error' => true];
            }
            break;
        case 'getAll':
            $taskObj = new \Todo\Task();
            $tasks = $taskObj->getAll();
            if ($tasks) {
                $reponse = ['text' => 'Task updated successfully', 'error' => false, 'data' => $tasks];
            } else {
                $reponse = ['text' => 'Task could not be save', 'error' => true];
            }
            break;
        default:
            $reponse = ['text' => 'Action not found', 'error' => true];
            break;
    }
    echo json_encode($reponse);
  die();
}