<?php   $this->layout('layout', ['title' => 'Tasks page']); ?>

<h3 class="text-center">My tasks</h3>
<br />
<table class='table'>
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Content</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($tasks as $task): ?>
            <tr>
                <td><?= $task['id']; ?></td>
                <td><?= $task['title']; ?></td>
                <td><?= $task['content']; ?></td>
                <td style="width: 20%;">
                    <a href="/show/<?= $task['id']; ?>" class='btn btn-info'>Show </a>
                    <a href="/edit/<?= $task['id']; ?>" class='btn btn-warning'>Edit</a>
                    <a onclick="return confirm(`Are you sure?`);" href="/delete/<?= $task['id']; ?>" class='btn btn-danger'>Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a href="/create" class="btn btn-success">Add</a>
