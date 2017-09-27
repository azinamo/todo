(function($){

    'use strict';

    var todo = window.Todo = {};

    var messageDiv = $("#message");
    var baseUrl = './task.php';
    var tasksTable = $("#tasks");

    todo.loadTasks = function(){
        messageDiv.html('...');
        $.get(baseUrl, {
            action: 'get_all',
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
            tasksTable.find('tbody').append( tasksHtml );
        }, 'html')
    };

    todo.addTask = function(data){
        messageDiv.html('saving task ...');
        todo.send('save', data, function(response){
            if (response.error) {
                messageDiv.addClass('alert-danger').html( response.text );
            } else {
                messageDiv.addClass('alert-success').html( response.text );
                todo.getTask(response.id);
            }
        }, 'json');
    };

    todo.deleteTask = function(){
        todo.send('delete', data, function(response){
            if (response.error) {
                messageDiv.addClass('alert-danger').html( response.text );
            } else {
                messageDiv.addClass('alert-success').html( response.text );
            }
        });
    };

    todo.updateTask = function(taskId, data){
        data.id = taskId;
        messageDiv.html('updating task ...');
        todo.send('update', data, function(response){
            if (response.error) {
                messageDiv.addClass('alert-danger').html( response.text );
            } else {
                messageDiv.addClass('alert-success').html( response.text );
            }
        }, 'json');
    };

    todo.updateAllTasks = function(tasks, data){
        messageDiv.html('updating all tasks ...');
        $.ajax({
            url : baseUrl,
            method: 'post',
            data: {'action': 'update_tasks', data: data, tasks: tasks },
            success: function(response){
                if (response.error) {
                    messageDiv.addClass('alert-danger').html( response.text );
                } else {
                    messageDiv.addClass('alert-success').html( response.text );
                }
            },
            error: function(){

            }
        });
    };



    todo.removeAll = function(){
        todo.send('removaAll', data, function(response){
            if (response.error) {
                messageDiv.addClass('alert-danger').html( response.text );
            } else {
                messageDiv.addClass('alert-success').html( response.text );
            }
        }, 'json');
    };

    todo.send = function(action, data, successFxn){
        $.ajax({
          url : baseUrl,
          method: 'post',
          dataType: 'json',
          data: {'action': action, data: data },
          success: successFxn,
          error: function(){

          }
        });
    }

    return todo

}(jQuery));