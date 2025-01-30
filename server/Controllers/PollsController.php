<?php

include_once __DIR__ . '/../Model/Polls.php';

class PollsController
{
    private $poll;

    public function __construct()
    {
        $this->poll = new Polls();
    }

    public function index()
    {
        $data = $this->poll->getAll();
        return json_encode($data);
    }

  

    public function update()
    {
        $id = $_POST['id'] ?? null;
        $title = $_POST['title'] ?? null;
        $description = $_POST['description'] ?? null;
        $created = $_POST['created'] ?? null;
        $shareable = $_POST['shareable'] ?? null;
        $public = $_POST['public'] ?? null;

        if (!$id || !$title || !$description || !$created || !$shareable || !$public) {
            return json_encode([
                "message" => "Error: 'id', 'title', 'description', 'created', 'shareable', and 'public' are required."
            ]);
        }

        $updateSuccess = $this->poll->update($id, $title, $description, $created, $shareable, $public);
        if ($updateSuccess) {
            return json_encode([
                "message" => "Poll updated successfully."
            ]);
        } else {
            return json_encode([
                "message" => "Error: Failed to update the poll."
            ]);
        }
    }

    public function delete()
    {
        $id = $_POST['id'] ?? null;
        if (!$id) {
            return json_encode([
                "message" => "Error: 'id' is required."
            ]);
        }

        $deleteSuccess = $this->poll->delete($id);

        if ($deleteSuccess) {
            return json_encode([
                "message" => "Poll successfully deleted."
            ]);
        } else {
            return json_encode([
                "message" => "Error: Failed to delete the poll."
            ]);
        }
    }

    public function find()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            return json_encode([
                'message' => 'No ID given.',
            ]);
        }

        $findSuccess = $this->poll->find($id);
        return json_encode([
            'poll' => $findSuccess,
            'message' => 'success',
        ]);
    }

    public function getPollsByUserId()
    {
        $userId = $_GET['user_id'] ?? null;

        if (!$userId) {
            return json_encode([
                "message" => "Error: user_id is required."
            ]);
        } else {
            $polls = $this->poll->getListOfPollsById($userId);
            if ($polls) {
                return json_encode([
                    "message" => "Success",
                    "poll" => $polls
                ]);
            } else {
                return json_encode([
                    "message" => "Error: No polls found for the given user_id."
                ]);
            }
        }
    }

    public function getPublicPolls()
    {
        $publicPolls = $this->poll->getAll();

        if ($publicPolls) {
            return json_encode([
                "message" => "success",
                "publicpoll" => $publicPolls
            ]);
        } else {
            return json_encode([
                "message" => "No public polls found."
            ]);
        }
    }

    public function addPoll()
    {
        $title = $_POST['title'] ?? null;
        $description = $_POST['description'] ?? null;
        $options = $_POST['option'] ?? [];
        $public = $_POST['public'] ?? [];

        if (!$title || !$description || !is_array($options) || empty($options)) {
            return json_encode([
                "message" => "Error: 'title', 'description', and 'option' (list) fields are required."
            ]);
        }

        $poll = $this->poll->create($title, $description, $public ,$options);

        if ($poll) {
            return json_encode([
                "message" => "success"
            ]);
        } else {
            return json_encode([
                "message" => "Error: Failed to add the poll"
            ]);
        }
    }
}

?>
