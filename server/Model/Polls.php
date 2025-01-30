<?php
include_once __DIR__ . '/Db.php';
include_once __DIR__ . '/Options.php';
class Polls
{
    private $pdo;
    public function __construct()
    {

        $temp = new Db();
        $this->pdo = $temp->connect();

    }
    public function create($title, $description, $options, $public , $userId)
    {
        $domain = 'http://localhost:3000';
        $dem = $this->pdo->prepare("INSERT INTO polls(title,description,public , created_by)VALUES(?,?,? , ?)");
        if ($dem->execute([$title, $description, $public , $userId])) {
            $id = $this->pdo->lastInsertId();
            
            $option = new Options();
            foreach ($options as $opt) {
                $option->create($id, $opt);
            }

            $link = $domain . '/vote/' . $id;
            $updateLink = $this->pdo->prepare("UPDATE polls SET shareable_link = ? WHERE poll_id = ?");
            $updateLink->execute([$link, $id]);

            return $id;
        }
        return false;
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
    public function getListOfPollsById($userId)
    {
        $dem = $this->pdo->prepare("
        SELECT polls.poll_id, polls.title, polls.description , polls.shareable_link, options.option_id, options.option_text, 
               COUNT(votes.option_id) as vote_count
        FROM polls
        INNER JOIN options ON polls.poll_id = options.poll_id
        LEFT JOIN votes ON votes.option_id = options.option_id
        WHERE polls.created_by = ?
        GROUP BY polls.poll_id, options.option_id
    ");
        $dem->execute([$userId]);

        $polls = [];
        $currentPollId = null;
        $poll = null;
        $options = [];

        while ($row = $dem->fetch()) {
            if ($currentPollId !== $row['poll_id']) {
                if ($poll) {
                    $poll['options'] = $options;
                    $polls[] = $poll;
                }
                $poll = [
                    'poll_id' => $row['poll_id'],
                    'title' => $row['title'],
                    'description' => $row['description'],
                    'shareable_link' => $row['shareable_link'],
                    'options' => [],
                ];
                $options = [];
                $currentPollId = $row['poll_id'];
            }

            $options[] = [
                'option_id' => $row['option_id'],
                'option_text' => $row['option_text'],
                'vote_count' => $row['vote_count'],
            ];
        }

        if ($poll) {
            $poll['options'] = $options;
            $polls[] = $poll;
        }

        return $polls;
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
    public function getListOfPollssById($userId)
    {
        $dem = $this->pdo->prepare("SELECT* FROM polls WHERE created_by = ?");
        $dem->execute($userId);
        return $dem->fetchAll();
    }
}



?>