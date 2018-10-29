<?php


class Task extends Model
{

    public function create($title, $description)
    {
        $data = [
            'title' => $title,
            'description' => $description,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        return $this->getBdd()->table('tasks')->insert($data);
    }

    public function showTask($id)
    {
        $req = $this->getBdd()->table('tasks')
            ->select('id, title, description, created_at,updated_at,success')
            ->where('id','=',$id)
            ->get();
        return $req;
    }

    public function showAllTasks()
    {
        $req = $this->getBdd()->table('tasks')
            ->select('id, title, description, created_at,updated_at,success')
            ->where('success','=',0)
            ->orderBy('created_at', 'desc')
            ->getAll();
        return $req;
    }

    /**
     * @param $status
     * 1 para las completadas
     * 0 para las no completadas
     * @return int
     */
    public function tasks_number_by_status($status){
        $req = $this->getBdd()->table('tasks')
            ->count('id','total_tasks')
            ->where('success','=',$status)
            ->get();
        return $req;
    }

    public function showCompleteTasks()
    {
        $req = $this->getBdd()->table('tasks')
            ->select('id, title, description,created_at,updated_at,success')
            ->where('success','=',1)
            ->orderBy('updated_at', 'desc')
            ->getAll();
        return $req;
    }



    public function edit($id, $title, $description)
    {
        $data = [
            'title' => $title,
            'description' => $description,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        return $this->getBdd()->table('tasks')->where('id','=', $id)->update($data);
    }

    public function success($id)
    {
        $data = [
            'success' => 1,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        return $this->getBdd()->table('tasks')->where('id','=', $id)->update($data);
    }

    public function delete($id)
    {
        return $this->getBdd()->table('tasks')->where('id','=', $id)->delete();
    }
}