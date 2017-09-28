<?php
error_reporting(1);
ini_set('display_errors', 1);

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

        <?php include_once 'includes/tasks.php'; ?>
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
            $("#response").show();
            var placeholder = $("#placeholder");
            var taskName = $("#task");
            if (taskName.val() == '') {
                alert('Please enter the task name');
                taskName.focus();
                return false;
            } else {
                $("#response").show();
                todo.addTask({'task': taskName.val()});
                taskName.val('');
                if (placeholder.length > 0) {
                    placeholder.remove();
                }
            }
        });
    });

    function markAsCompleted(el, taskId){
        if ($(el).is(":checked")) {
            var tasks = [taskId];
            $("#response").show();
            todo.updateTasks(tasks, {'status' : 'completed'})
        }
    }

    function markAllCompleted(el, taskId){
        if ($(el).is(":checked")) {
            var tasks = [];
            $(".completed").each(function(){
                tasks.push($(this).val());
            });
            $("#response").show();
            todo.updateTasks(tasks, {'status' : 'completed'})
        }
    }

</script>
</body>
</html>
