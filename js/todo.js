(function($){

    'use strict';

    var todo = window.Todo = {};

    var messageDiv = $("#message");
    var baseUrl = './task.php';

    todo.addTask = function(data){
        messageDiv.html('saving task ...');
        todo.send('save', data, function(response){
            if (response.error) {
                messageDiv.addClass('alert-danger').html( response.text );
            } else {
                messageDiv.addClass('alert-success').html( response.text );
            }
        });
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
          data: {'action': action, data: data },
          success: successFxn,
          error: function(){

          }
        });
    }

    return todo

}(jQuery));