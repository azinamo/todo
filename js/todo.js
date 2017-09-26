(function($){

    'use strict';

    var todo = window.Todo = {};

    var messageDiv = $("#message");
    var baseUrl = '/todo/task.php';

    todo.addTask = function(data){
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

    todo.updateTask = function(){
        todo.send('update', data, function(response){
            if (response.error) {
                messageDiv.addClass('alert-danger').html( response.text );
            } else {
                messageDiv.addClass('alert-success').html( response.text );
            }
        }, 'json');
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
        console.log( baseUrl );
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