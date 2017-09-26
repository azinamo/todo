<?php
require_once 'dbconf.php';
require_once 'classes/DBConn.php';
require_once 'classes/Task.php';
$taskObj = new \Todo\Task();
$tasks = $taskObj->getTasks();
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
        <span id="message"></span>
        <table id="todo" class="table table-bordered">
            <tr>
                <th>
                    <input type="checkbox" name="all_completed" name="all_completed" class="checkbox all_completed" onchange="markAllCompleted(this)" />
                </th>
                <th>Task</th>
                <th>
                    Completed
                </th>
            </tr>
            <?php if (!empty($tasks)): ?>
                <?php foreach($tasks as $task): ?>
                    <tr>
                        <td><?php echo $task['task']; ?></td>
                        <td>
                            <?php if($task['status'] !== 'completed'): ?>
                                <input type="checkbox" name="is_completed_<?php echo $task['id']; ?>" value="<?php echo $task['id']; ?>" name="is_completed[<?php echo $task['id']; ?>]" class="checkbox completed" onchange="markAsCompleted(this, '<?php echo $task['id']; ?>')" />
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
    var todo = window.Todo || {};
    $(function(){

        $("#add_task").on('click', function(){
            var taskName = $("#task").val()
            if (taskName == '') {
                alert('Please enter the task name');
                return false;
            } else {
                todo.addTask({'task': taskName});
            }
        });
    });

    function markAsCompleted(el, taskId){
        if ($(el).is(":checked")) {
            todo.updateTask(taskId, {'status' : 'completed'})
        }
    }

    function markAllCompleted(el, taskId){
        if ($(el).is(":checked")) {
            var tasks = [];
            $(".completed").each(function(){
                tasks.push($(this).val());
            });
            todo.updateAllTasks(tasks, {'status' : 'completed'})
        }
    }

</script>
</body>
</html>
