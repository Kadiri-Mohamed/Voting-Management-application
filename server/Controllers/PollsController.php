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
        return $data;
    }

    public function add()
    {
        $title = $_POST['title'] ?? null;
        $description = $_POST['description'] ?? null;
        $created = $_POST['created'] ?? null;
        $shareable = $_POST['shareable'] ?? null;
        $public = $_POST['public'] ?? null;

        if (!$title) {
            return "Error: 'title' is required.";
        }
        if (!$description) {
            return "Error: 'description' is required.";
        }
        if (!$created) {
            return "Error: 'created' is required.";
        }
        if (!$shareable) {
            return "Error: 'shareable' is required.";
        }
        if (!$public) {
            return "Error: 'public' is required.";
        }

        $addSuccess = $this->poll->add($title, $description, $created, $shareable, $public);
        if ($addSuccess) {
            return "Poll added successfully.";
        } else {
            return "Error: Failed to add the poll.";
        }
    }

    public function update()
    {
        $id = $_POST['id'] ?? null;
        $title = $_POST['title'] ?? null;
        $description = $_POST['description'] ?? null;
        $created = $_POST['created'] ?? null;
        $shareable = $_POST['shareable'] ?? null;
        $public = $_POST['public'] ?? null;

        if (!$id) {
            return "Error: 'id' is required.";
        }
        if (!$title) {
            return "Error: 'title' is required.";
        }
        if (!$description) {
            return "Error: 'description' is required.";
        }
        if (!$created) {
            return "Error: 'created' is required.";
        }
        if (!$shareable) {
            return "Error: 'shareable' is required.";
        }
        if (!$public) {
            return "Error: 'public' is required.";
        }

        $updateSuccess = $this->poll->update($id, $title, $description, $created, $shareable, $public);
        if ($updateSuccess) {
            return "Poll updated successfully.";
        } else {
            return "Error: Failed to update the poll.";
        }
    }

    public function delete()
    {
        $id = $_POST['id'] ?? null;
        if (!$id) {
            return "Error: 'id' is required.";
        }

        $deleteSuccess = $this->poll->delete($id);

        if ($deleteSuccess) {
            return "Poll successfully deleted.";
        } else {
            return "Error: Failed to delete the poll.";
        }
    }

    public function find()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            echo json_encode([
                'message' => 'No ID given.',
            ]);
            return;
        }

        $findSuccess = $this->poll->find($id);
        echo json_encode([
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

        if (!$title || !$description || !is_array($options) || empty($options)) {
            return json_encode([
                "message" => "Error: 'title', 'description', and 'option' (list) fields are required."
            ]);
        }

        $poll = $this->poll->add($title, $description, $options);

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