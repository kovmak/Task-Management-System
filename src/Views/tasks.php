<h1>Your Tasks</h1>
<table>
    <thead>
    <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Status</th>
        <th>Assigned To</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($tasks as $task): ?>
        <tr>
            <td><?php echo htmlspecialchars($task['title']); ?></td>
            <td><?php echo htmlspecialchars($task['description']); ?></td>
            <td><?php echo htmlspecialchars($task['status']); ?></td>
            <td><?php echo htmlspecialchars($task['assigned_to_id']); ?></td>
            <td>
                <a href="/tasks/edit/<?php echo $task['id']; ?>">Edit</a>
                <a href="/tasks/delete/<?php echo $task['id']; ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<form action="/task/create" method="POST">
    <input type="text" name="title" placeholder="Task title" required>
    <textarea name="description" placeholder="Task description"></textarea>
    <button type="submit">Create Task</button>
</form>
