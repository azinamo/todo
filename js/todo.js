(function($){

    'use strict';

    var todo = window.Todo = {};

    var responseTr = $("#response");
    var messageDiv = $("#message");
    var baseUrl = './task.php';
    var tasksTable = $("#tasks");

    todo.getTasks = function(taskIds){
        messageDiv.html('...');
        $.get(baseUrl, {
            action: 'get_all', task_ids: taskIds,
        }, function(tasksHtml) {
            $("#tasks").html( tasksHtml );
        }, 'html')
    };

    todo.getTask = function(taskId){
        messageDiv.html('Updating ...');
        $.get(baseUrl, {
            action: 'get_task',
            task_id: taskId
        }, function(tasksHtml) {
            messageDiv.html('');
            responseTr.hide();
            var taskTr = $("#tr-task-" + taskId);
            if ( taskTr.length > 0) {
                taskTr.replaceWith( tasksHtml );
            } else {
                tasksTable.find('tbody').prepend( tasksHtml );
            }
        }, 'html')
    };

    todo.addTask = function(data){
        messageDiv.html('saving task ...');
        $.post(baseUrl, {'action': 'save', data: data }, function(response){
            if (response.error) {
                messageDiv.addClass('alert-danger').html( response.text );
            } else {
                messageDiv.addClass('alert-success').html( response.text );
                todo.getTask(response.id);
            }
        }, 'json');
    };

    todo.updateTasks = function(tasks, data){
        messageDiv.html('updating all tasks ...');
        $.post(baseUrl, {'action': 'update_tasks', data: data, tasks: tasks }, function(response){
            if (response.error) {
                messageDiv.addClass('alert-danger').html( response.text );
            } else {
                messageDiv.addClass('alert-success').html( response.text );
                $.each(tasks, function(index, task){
                    $("#task-" + task + "-status").html('<i class="alert-success">Completed</i>');
                });
                setTimeout(function(){
                    messageDiv.html('');
                    responseTr.hide();
                }, 1000)
            }
        }, 'json');
    };

    return todo

}(jQuery));