<?php

namespace app\models;

use Aura\SqlQuery\QueryFactory;
use PDO;

class QueryBuilder
{
    private $query;
    private $pdo;

    public function __construct(QueryFactory $query, PDO $pdo)
    {
        $this->query = $query;
        $this->pdo = $pdo;
    }

    public function getAll($table)
    {
        $select = $this->query->newSelect();
        $select->cols(['*'])
            ->from($table);

        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        $tasks = $sth->fetchAll();

        return $tasks;
    }

    public function insertOne($table)
    {
        $insert = $this->query->newInsert();
        $insert->into($table)
            ->cols([
                'title' => ':title',
                'content' => ':content',
            ])
            ->bindValues([
                ':title' => $_POST['title'],
                ':content' => $_POST['content'],
            ]);

        $sth = $this->pdo->prepare($insert->getStatement());
        $sth->execute($insert->getBindValues());

        header('Location: /');
    }

    public function getOne($table, $id)
    {
        $select = $this->query->newSelect();
        $select->cols(['*'])
            ->from($table)
            ->where('id = :id')
            ->bindValue('id', $id);

        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        $task = $sth->fetch(PDO::FETCH_ASSOC);

        return $task;
    }

    public function updateOne($table, $id)
    {
        $update = $this->query->newUpdate();
        $update
            ->table($table)
            ->cols(['title', 'content'])
            ->where('id = :id')
            ->bindValues([
                ':id' => $id,
                ':title' => $_POST['title'],
                ':content' => $_POST['content'],
            ]);

        $sth = $this->pdo->prepare($update->getStatement());
        $sth->execute($update->getBindValues());

        header('Location: /');
    }

    public function deleteOne($table, $id)
    {
        $delete = $this->query->newDelete();
        $delete
            ->from($table)
            ->where('id = :id')
            ->bindValue('id', $id);

        $sth = $this->pdo->prepare($delete->getStatement());
        $sth->execute($delete->getBindValues());

        header('Location: /');
    }
}
