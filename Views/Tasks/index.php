<h1>Tasks</h1>
<div class="row col-md-12 centered">
    <div class="margin-med">
        <a href="/ligne_php/tasks/create/" class="btn btn-primary btn-xs pull-right">
            <strong>+</strong>&Tab;New task
        </a>
        <a href="/ligne_php/tasks/completetasks/" class="btn btn-success btn-xs">
            Complete Task's
        </a>
        <button class="btn">#&Tab;<?php echo $cantidad_tareas['total_tasks'] ?></button>
    </div>
    <table class="table table-striped custab">
        <thead>
        <tr>
            <th>ID</th>
            <th>Task</th>
            <th>Description</th>
            <th>Date</th>
            <th class="text-center">Action</th>
        </tr>
        </thead>
        <?php foreach ($tasks as $task): ?>
            <tr>
                <td><?= $task["id"] ?> </td>
                <td><?= $task["title"] ?> </td>
                <td><?= $task["description"] ?> </td>
                <td><?= $task["created_at"] ?> </td>
                <td class="text-center">
                    <a class="btn btn-info btn-xs" href="/ligne_php/tasks/edit/<?= $task["id"] ?>" >
                        Edit
                    </a>
                    <a href="/ligne_php/tasks/delete/<?= $task["id"] ?>" class="btn btn-danger btn-xs">
                        Del
                    </a>
                    <a href="/ligne_php/tasks/success/<?= $task["id"] ?>" class="btn btn-success btn-sx">
                        Success
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>