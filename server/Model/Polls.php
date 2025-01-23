<?php
include_once __DIR__ . '/Db.php';
class Polls
{
    private $pdo;
    public function __construct()
    {

        $temp = new Db();
        $this->pdo = $temp->connect();

    }
    public function create($title, $description, $created, $shareable, $public)
    {
        $dem = $this->pdo->prepare("INSERT INTO polls(title,description,created,shareable,public)VALUE(?,?,?,?,?)");
        return $dem->execute([$title, $description, $created, $shareable, $public]);
    }
    public function update($id, $title, $description, $created, $shareable, $public)
    {
        $dem = $this->pdo->prepare("UPDATE polls SET title = ?, description = ?,created=?,shareable=?,public=?  WHERE id = ?");
        return $dem->execute([$title, $description, $created, $shareable, $public, $id]);
    }
    public function find($id)
    {
        $dem = $this->pdo->prepare("
        SELECT polls.poll_id, polls.title, polls.description, options.option_id, options.option_text, 
               COUNT(votes.option_id) as vote_count
        FROM polls
        INNER JOIN options ON polls.poll_id = options.poll_id
        LEFT JOIN votes ON votes.option_id = options.option_id
        WHERE polls.poll_id = ?
        GROUP BY options.option_id
    ");
        $dem->execute([$id]);

        $poll = null;
        $options = [];

        while ($row = $dem->fetch()) {
            if (!$poll) {
                $poll = [
                    'poll_id' => $row['poll_id'],
                    'title' => $row['title'],
                    'description' => $row['description'],
                    'options' => [],
                ];
            }

            $options[] = [
                'option_id' => $row['option_id'],
                'option_text' => $row['option_text'],
                'vote_count' => $row['vote_count'], // Include the vote count
            ];
        }

        if ($poll) {
            $poll['options'] = $options;
        }

        return $poll;
    }

    public function delete($id)
    {
        $dem = $this->pdo->prepare("DELETE FROM polls WHERE poll_id=?");
        return $dem->execute([$id]);
    }
    public function getAll()
    {
        $dem = $this->pdo->prepare("SELECT* FROM polls WHERE public=true");
        $dem->execute();
        return $dem->fetchAll();
    }
    public function getListOfPollssById($userId){
        $dem = $this->pdo->prepare("SELECT* FROM polls WHERE created_by = ?");
        $dem->execute($userId);
        return $dem->fetchAll();
    }
}



?>