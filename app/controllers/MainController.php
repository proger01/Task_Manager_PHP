<?php

namespace app\controllers;

use League\Plates\Engine;
use app\models\QueryBuilder;

class MainController
{
    private $view;
    private $queryBuilder;

    public function __construct(Engine $view, QueryBuilder $queryBuilder)
    {
        $this->view = $view;
        $this->queryBuilder = $queryBuilder;
    }

    public function index()
    {
        $tasks = $this->queryBuilder->getAll('some');

        echo $this->view->render('tasks', ['tasks' => $tasks]);
    }

    public function create()
    {
        echo $this->view->render('create');
    }

    public function store()
    {
        $this->queryBuilder->insertOne('some');
    }

    public function show($id)
    {
        $task = $this->queryBuilder->getOne('some', $id);

        echo $this->view->render('show', ['task' => $task]);
    }

    public function edit($id)
    {
        $task = $this->queryBuilder->getOne('some', $id);

        echo $this->view->render('edit', ['task' => $task]);
    }

    public function update($id)
    {
        $this->queryBuilder->updateOne('some', $id);
    }

    public function delete($id)
    {
        $this->queryBuilder->deleteOne('some', $id);
    }
}