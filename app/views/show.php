<?php $this->layout('layout', ['title' => 'Task']); ?>

<h3 class="text-center">My task</h3>
<br />
<table class="table">
    <thead>
        <tr>
            <th>Title</th>
            <th>Content</th>
        </tr>
    </head>
    <tbody>
        <tr>
            <td><?= $task['title']; ?></td>
            <td><?= $task['content']; ?></td>
        </tr>
    </tbody>
</table>
<a href="/" class="btn btn-success">Back</a>
