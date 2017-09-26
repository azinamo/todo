<?php
include_once 'classes/DBConn.php';
include_once 'classes/Model.php';
include_once 'classes/Task.php';
$taskObj = new \Todo\Task();
$tasks = $taskObj->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>TODO</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

</head>

<body>
<div class="container">

    <h1>TODO</h1>
    <div class="row">
        <table id="todo" class="table table-bordered">
            <tr>
                <td>Task</td>
                <td>Completed</td>
            </tr>
            <?php if (!empty($tasks)): ?>
                <?php foreach($tasks as $task): ?>
                    <tr>
                        <td><?php echo $task->task; ?></td>
                        <td>
                            <?php if($task->is_completed): ?>
                                <input type="checkbox" name="is_completed_<?php echo $task->task; ?>"  name="is_completed[<?php echo $task->task; ?>]" class="checkbox completed" />
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="2">No tasks found</td>
                </tr>
            <?php endif; ?>
            <tr>
                <td><input type="text" name="task" id="task" class="form-control"></td>
                <td><input type="button" name="add_task" id="add_task" value="Add" class="btn btn-primary" /></td>
            </tr>
        </table>
    </div>


</div> <!-- /container -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/todo.js"></script>
<script>
    $(function(){
        var todo = window.Todo || {};
        console.log( todo );
        $("#add_task").on('click', function(){
            var taskName = $("#task").val()
            if (taskName == '') {
                alert('Please enter the task name');
                return false;
            } else {
                todo.addTask({'name': taskName});
            }
        });

    });
</script>
</body>
</html>
