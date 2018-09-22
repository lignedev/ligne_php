<h1>Tasks</h1>
<div class="row col-md-12 centered">
    <table class="table table-striped custab">
        <thead>
        <a href="/ligne_php/tasks/create/" class="btn btn-primary btn-xs pull-right">
            <strong>+</strong>&Tab;New task
        </a>
        <tr>
            <th>ID</th>
            <th>Task</th>
            <th>Description</th>
            <th class="text-center">Action</th>
        </tr>
        </thead>

        <?php foreach ($tasks as $task): ?>
            <tr>
                <td> <?= $task["id"] ?> </td>
                <td><?= $task["title"] ?> </td>
                <td><?= $task["description"] ?> </td>
                <td class="text-center">
                    <a class="btn btn-info btn-xs" href="/ligne_php/tasks/edit/<?= $task["id"] ?>" >
                        Edit
                    </a>
                    <a href="/ligne_php/tasks/delete/<?= $task["id"] ?>" class="btn btn-danger btn-xs">
                        Del
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>
</div>