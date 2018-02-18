<?php namespace App\Controllers;

use \Core\View;
use App\Models\Task;
use App\Services\RouteFactory;

class TasksController extends \Core\Controller
{
    public function indexAction() {
        $params['tasks'] = Task::getAll();

        View::renderTemplate('Tasks/tasks.html', $params);
    }

    public function createAction() {
        Task::create([
            'description' => 'Task #',
            'checked' => 'false'
        ]);

        RouteFactory::redirect('/tasks');
    }

    public function updateAction() {
        $data = $_POST;

        list('id' => $id, 'name' => $name, 'value' => $value) = $data;

        if(empty($id) || empty($name) || empty($value)) {
            return null;
        }

        Task::update([
            'id' => $id,
            'name' => $name,
            'value' => $value
        ]);
    }
}
