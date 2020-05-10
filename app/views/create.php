<?php $this->layout('layout', ['title' => 'Create task']); ?>

<h3 class="text-center">Create new task</h3>
<br />
<form action="/store" method="post">
    <div class="form-group">
        <input type="text" class="form-control" name="title"></input>
    </div>

    <div class="form-group">
        <textarea type="text" class="form-control" name="content"></textarea>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-success">Create</button>
    </div>
</form>
