<?php
include_once __DIR__ . '/../Model/Votes.php';


class VotesController {
    private $vote; 

    public function __construct() {
        $this->vote = new Votes(); 
    }

    public function index() {
        $data = $this->vote->getAll(); 
        return json_encode($data);
    }

    public function add(){
        $poll_id = $_POST['poll_id'] ?? null;
        $user_id = $_POST['user_id'] ?? null;
        $option_id = $_POST['option_id'] ?? null;

        if (!$poll_id) {
            return json_encode(['status' => 'error', 'message' => "'poll_id' is required."]);
        }
        if (!$user_id) {
            return json_encode(['status' => 'error', 'message' => "'user_id' is required."]);
        }
        if (!$option_id) {
            return json_encode(['status' => 'error', 'message' => "'option_id' is required."]);
        }

        $addSuccess = $this->vote->create($poll_id, $user_id, $option_id);
        
        if ($addSuccess) {
            return json_encode(['status' => 'success', 'message' => 'Option added successfully']);
        } else {
            return json_encode(['status' => 'error', 'message' => 'Failed to add the option']);
        }
    }
    
    public function update(){
        $id = $_POST['id'] ?? null;
        $poll_id = $_POST['poll_id'] ?? null;
        $user_id = $_POST['user_id'] ?? null;
        $option_id = $_POST['option_id'] ?? null;

        if (!$id) {
            return json_encode(['status' => 'error', 'message' => "'id' is required."]);
        }
        if (!$poll_id) {
            return json_encode(['status' => 'error', 'message' => "'poll_id' is required."]);
        }
        if (!$user_id) {
            return json_encode(['status' => 'error', 'message' => "'user_id' is required."]);
        }
        if (!$option_id) {
            return json_encode(['status' => 'error', 'message' => "'option_id' is required."]);
        }

        $updateSuccess = $this->vote->update( $poll_id, $user_id, $option_id);

        if ($updateSuccess) {
            return json_encode(['status' => 'success', 'message' => 'Option updated successfully']);
        } else {
            return json_encode(['status' => 'error', 'message' => 'Failed to update the option']);
        }
    }

    public function delete() {
        $id = $_POST['id'] ?? null;
        if (!$id) {
            return json_encode(['status' => 'error', 'message' => "'id' is required."]);
        }
        
        $deleteSuccess = $this->vote->delete($id);
        
        if ($deleteSuccess) {
            return json_encode(['status' => 'success', 'message' => 'Option successfully deleted.']);
        } else {
            return json_encode(['status' => 'error', 'message' => 'Failed to delete the option.']);
        }
    }
    
    public function find() {
        $pollId = $_POST['poll_id'] ?? null;
        $userId = $_POST['user_id'] ?? null;
        
        if (!$pollId || !$userId) {
            return json_encode(['status' => 'error', 'message' => "'id' is required."]);
        }
        
        $findSuccess = $this->vote->find($pollId, $userId);
        return json_encode($findSuccess);
    }

    public function vote(){
        $userId = $_POST["user_id"] ?? 0;
        $pollId = $_POST["poll_id"] ?? null;
        $optionId = $_POST["option_id"] ?? null;
        
        
        if ($userId == 0 || !$pollId || !$optionId) {
            return json_encode([
                'status' => 'error',
                'message' => 'All fields are required (user_id, poll_id, option_id).'
            ]);
        }
       
        $exist = $this->vote->find($pollId, $userId);
        if ($exist) {
            $updateVote = $this->vote->update($pollId, $userId, $optionId);
            if ($updateVote) {
                return json_encode([
                    'status'=> 'success',
                    'message'=> 'Vote updated successfully'
                ]);
            } else {
                return json_encode([
                    'status'=> 'error',
                    'message'=> 'Failed to update the vote'
                ]);
            }
        } else {
            $createVote = $this->vote->create($pollId, $userId, $optionId);
            if ($createVote) {
                return json_encode([
                    'status'=> 'success',
                    'message'=> 'Vote created successfully'
                ]);
            } else {
                return json_encode([
                    'status'=> 'error',
                    'message'=> 'Failed to submit the vote'
                ]);
            }
        }
    }
}

?>
