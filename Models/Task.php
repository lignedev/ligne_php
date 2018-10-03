<?php
class Task extends Model
{
    public function create($title, $description)
    {
        $sql = "INSERT INTO tasks (title, description, created_at, updated_at) VALUES (:title, :description, :created_at, :updated_at)";
        $req = Database::getBdd()->prepare($sql);
        return $req->execute([
            'title' => $title,
            'description' => $description,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function showTask($id)
    {
        $sql = "SELECT id,title,description,created_at,updated_at,success FROM tasks WHERE id =" . $id;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch();
    }

    public function showAllTasks()
    {
        $sql = "SELECT id,title,description,created_at,updated_at,success FROM tasks WHERE success = 0 ORDER BY created_at DESC";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }

    public function showCompleteTasks()
    {
        $sql = "SELECT id,title,description,created_at,updated_at,success FROM tasks WHERE success = 1 ORDER BY updated_at DESC";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }

    public function edit($id, $title, $description)
    {
        $sql = "UPDATE tasks SET title = :title, description = :description , updated_at = :updated_at WHERE id = :id";
        $req = Database::getBdd()->prepare($sql);
        return $req->execute([
            'id' => $id,
            'title' => $title,
            'description' => $description,
            'updated_at' => date('Y-m-d H:i:s')

        ]);
    }

    public function success($id)
    {
        $sql = "UPDATE tasks SET success = :success, updated_at = :updated_at WHERE id = :id";
        $req = Database::getBdd()->prepare($sql);
        return $req->execute([
            'id' => $id,
            'success' => 1,
            'updated_at' => date('Y-m-d H:i:s')

        ]);
    }

    public function delete($id)
    {
        $sql = 'DELETE FROM tasks WHERE id = ?';
        $req = Database::getBdd()->prepare($sql);
        return $req->execute([$id]);
    }
}