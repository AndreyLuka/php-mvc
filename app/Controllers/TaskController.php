<?php

namespace App\Controllers;

use Core\Controller;
use Core\Pagination;
use App\Models\Task;
use App\Services\ImageUpload;

/**
 * Class TaskController.
 */
class TaskController extends Controller
{
    /**
     * Show the index page.
     * @return string
     */
    public function indexAction()
    {
        Task::setDb($this->db);

        $pagination = new Pagination(Task::countAll(), $this->request->getQueryParam('p'));

        return $this->view->render('tasks/index', [
            'tasks' => Task::findAll(
                $this->request->getQueryParam('order_by'),
                $this->request->getQueryParam('direction'),
                $pagination->getOffset()
            ),
            'pagination' => $pagination,
            'auth' => $this->auth,
            'request' => $this->request]
        );
    }

    /**
     * Create new Task.
     * @return string
     */
    public function newAction()
    {
        Task::setDb($this->db);

        if ($this->request->isPost()) {
            if ($this->request->isFile('image')) {
                $image = new ImageUpload();
                $imageName = $image->upload(
                    $this->request->getFile('image'),
                    IMG_MAX_WIDTH,
                    IMG_MAX_HEIGHT
                );
            }

            $task = new Task(
                $this->request->getRequestParam('username'),
                $this->request->getRequestParam('email'),
                $this->request->getRequestParam('text'),
                isset($imageName) ? $imageName : null
            );
            if (!$this->auth->guest() && $this->auth->user()->isAdmin()) {
                $task->setStatus(!is_null($this->request->getRequestParam('status')) ? 1 : 0);
            }
            $task->save();

            return $this->indexAction();
        }

        return $this->view->render('tasks/new', ['auth' => $this->auth]);
    }

    /**
     * Edit Task.
     * @return string
     * @throws \Exception
     */
    public function editAction()
    {
        if ($this->auth->guest() || !$this->auth->user()->isAdmin()) {
            throw new \Exception('Authorization error');
        }

        Task::setDb($this->db);

        $task = Task::find($this->request->getQueryParam('id'));

        if ($this->request->isPost()) {
            if ($this->request->isFile('image')) {
                $imageUpload = new ImageUpload();
                $imageName = $imageUpload->upload(
                    $this->request->getFile('image'),
                    IMG_MAX_WIDTH,
                    IMG_MAX_HEIGHT
                );

                !is_null($task->getImage()) ? $imageUpload->delete($task->getImage()) : null;
            }

            $task->setUsername($this->request->getRequestParam('username'));
            $task->setEmail($this->request->getRequestParam('email'));
            $task->setText($this->request->getRequestParam('text'));
            isset($imageName) ? $task->setImage($imageName) : null;
            $task->setStatus(!is_null($this->request->getRequestParam('status')) ? 1 : 0);
            $task->update();

            return $this->indexAction();
        }

        return $this->view->render('tasks/edit', [
            'task' => $task,
            'auth' => $this->auth]
        );
    }

    /**
     * Delete Task.
     * @return string
     * @throws \Exception
     */
    public function deleteAction()
    {
        if ($this->auth->guest() || !$this->auth->user()->isAdmin()) {
            throw new \Exception('Authorization error');
        }

        Task::setDb($this->db);

        $task = Task::find($this->request->getQueryParam('id'));
        $imageUpload = new ImageUpload();
        !is_null($task->getImage()) ? $imageUpload->delete($task->getImage()) : null;
        $task->delete();

        return $this->indexAction();
    }
}
