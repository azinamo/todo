<table id="tasks" class="table table-bordered">
    <thead>


        <tr>
            <td><input type="text" name="task" id="task" class="form-control" placeholder="Add Task" /></td>
            <td colspan="2"><input type="button" name="add_task" id="add_task" value="Add" class="btn btn-primary" /></td>
        </tr>
        <tr>
            <th>Task</th>
            <th>
                <input type="checkbox" name="all_completed" name="all_completed" class="checkbox all_completed" onchange="markAllCompleted(this)" />
                Mark As Completed
            </th>
        </tr>
    </thead>
    <tbody>
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
                <td colspan="3">No tasks found</td>
            </tr>
        <?php endif; ?>
    </tbody>

</table>