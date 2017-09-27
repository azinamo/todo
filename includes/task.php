<tr>
    <td><?php echo $task['task']; ?></td>
    <td>
        <?php if($task['status'] !== 'completed'): ?>
            <input type="checkbox" name="is_completed_<?php echo $task['id']; ?>" value="<?php echo $task['id']; ?>" name="is_completed[<?php echo $task['id']; ?>]" class="checkbox completed" onchange="markAsCompleted(this, '<?php echo $task['id']; ?>')" />
        <?php endif; ?>
    </td>
</tr>