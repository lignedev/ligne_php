<h1>Complete Tasks</h1>
<div class="row col-md-12 centered">
    <div class="margin-med">
        <a href="<?= Assets::href("tasks/create")?>" class="btn btn-primary btn-xs pull-right">
            <strong>+</strong>&Tab;New task
        </a>
        <a href="<?= Assets::href("tasks/index")?>" class="btn btn-primary btn-xs">
            All Task's
        </a>
        <button class="btn">#&Tab;<?php echo $cantidad_tareas['total_tasks'] ?></button>
    </div>
    <table class="table table-striped custab">
        <thead>
        <tr>
            <th>ID</th>
            <th>Task</th>
            <th>Description</th>
            <th>Date Succes</th>
        </tr>
        </thead>
        <?php foreach ($tasks as $task): ?>
            <tr>
                <td><?= $task["id"] ?> </td>
                <td><?= $task["title"] ?> </td>
                <td><?= $task["description"] ?> </td>
                <td><?= $task["updated_at"] ?> </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>