<?php
/**
 * Controlar cuando no exista un controlador
 * acceso ejemplo: http://localhost/ligne_php/tasks/index
 * donde create es el metodo al que se accede
**/

include (ROOT . 'Models/Tasks/Task.php');

class TasksController extends Controller
{
    function index()
    {
        $tasks = new Task();
        $data['tasks'] = $tasks->showAllTasks();
        $data['cantidad_tareas'] = $tasks->tasks_number_by_status(0);
        $this->setData($data); //envia datos a la vista
        $this->render("index",'Index Page'); //Renderiza la vista con un titulo
    }

    function completetasks()
    {
        $tasks = new Task();
        $data['tasks'] = $tasks->showCompleteTasks();
        $data['cantidad_tareas'] = $tasks->tasks_number_by_status(1);
        $this->setData($data); //envia datos a la vista
        $this->render("completetasks",'Complete Tasks'); //Renderiza la vista
    }

    function create()
    {
        if (isset($_POST["title"]))
        {
            $task= new Task();

            if ($task->create($_POST["title"], $_POST["description"]))
            {
                $this->redirect(array('controller'=>'tasks','action'=>'index'));
            }
        }
        $this->render("create",'Create a Task');
    }

    function edit($id)
    {
        $task= new Task();

        $data["task"] = $task->showTask($id);
        if (isset($_POST["title"]))
        {
            if ($task->edit($id, $_POST["title"], $_POST["description"]))
            {
                $this->redirect(array('controller'=>'tasks','action'=>'index'));
            }
        }
        $this->setData($data);
        $this->render("edit",'Edit Task '. $id);
    }

    function delete($id)
    {
        $task = new Task();
        if ($task->delete($id))
        {
            $this->redirect(array('controller'=>'tasks','action'=>'index'));
        }
    }

    function success($id)
    {
        $task = new Task();
        if ($task->success($id))
        {
            $this->redirect(array('controller'=>'tasks','action'=>'index'));
        }
    }
}