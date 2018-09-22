<?php
/**
 * Controlar cuando no exista un controlador
 * acceso ejemplo: http://localhost/ligne_php/tasks/create
 * donde create es el metodo al que se accede
**/

class tasksController extends Controller
{
    function index()
    {
        require(ROOT . 'Models/Task.php');

        $tasks = new Task();
        $data['tasks'] = $tasks->showAllTasks();
        $this->set($data); //envia datos a la vista
        $this->render("index"); //Renderiza la vista
    }

    function create()
    {
        if (isset($_POST["title"]))
        {
            require(ROOT . 'Models/Task.php');

            $task= new Task();

            if ($task->create($_POST["title"], $_POST["description"]))
            {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }

        $this->render("create");
    }

    function edit($id)
    {
        require(ROOT . 'Models/Task.php');
        $task= new Task();

        $data["task"] = $task->showTask($id);

        if (isset($_POST["title"]))
        {
            if ($task->edit($id, $_POST["title"], $_POST["description"]))
            {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }
        $this->set($data);
        $this->render("edit");
    }

    function delete($id)
    {
        require(ROOT . 'Models/Task.php');

        $task = new Task();
        if ($task->delete($id))
        {
            header("Location: " . WEBROOT . "tasks/index");
        }
    }
}