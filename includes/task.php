<tr id="tr-task-<?php echo $task['id']; ?>">
    <td><?php echo $task['task']; ?></td>
    <td id="task-<?php echo $task['id']; ?>-status">
        <?php if($task['status'] == 'completed'): ?>
            <i class="alert-success">Completed</i>
       <?php else: ?>
            <input type="checkbox" name="is_completed_<?php echo $task['id']; ?>" value="<?php echo $task['id']; ?>" name="is_completed[<?php echo $task['id']; ?>]" class="checkbox completed" onchange="markAsCompleted(this, '<?php echo $task['id']; ?>')" />
        <?php endif; ?>
    </td>
</tr>