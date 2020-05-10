<?php $this->layout('layout', ['title' => 'Edit task']); ?>

<h3 class="text-center">Create new task</h3>
<br />
<form action="/update/<?= $task['id']; ?>" method="post">
    <div class="form-group">
        <input type="text" class="form-control" name="title" value="<?= $task['title']; ?>"></input>
    </div>

    <div class="form-group">
        <input type="text" class="form-control" name="content" value="<?= $task['content']; ?>"></input>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-success">Edit</button>
    </div>
</form>
