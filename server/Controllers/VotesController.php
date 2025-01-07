<?php

include './../Models/Votes.php';


class VotesController {
    private $vote; 

    public function __construct() {
        $this->vote = new Votes(); 
    }

    public function index() {
        $data = $this->vote->getAll(); 
        return $data;
    }

    public function add(){
        $poll_id = $POST_['poll_id'] ?? null;
        $user_id = $POST_['user_id'] ?? null;
        $option_id = $POST_['option_id'] ?? null;

        if (!$poll_id) {
           return "Error: 'poll_id' is required.";
        }
        if (!$user_id) {
           return "Error: 'user_id' is required.";
        }
        if (!$option_id) {
            return "Error: 'option_id' is required.";
         }

        $addSuccess=$this->vote->add($poll_id,$user_id,$option_id);
        
        if($addSuccess){
            return "Option add successfully";
        }else{
            return "Error: Failed to add the option";
        }
    }
    
    public function update(){
        $id = $POST_['id']?? null;
        $poll_id = $POST_['poll_id']?? null;
        $user_id = $POST_['user_id']?? null;
        $option_id = $POST_['option_id']?? null;

        if (!$id) {
            return "Error: 'id' is required.";
        }
        if (!$poll_id) {
            return "Error: 'poll_id' is required.";
        }
        if (!$user_id) {
            return "Error: 'user_id' is required.";
        }
        if (!$option_id) {
            return "Error: 'option_id' is required.";
        }

        $updateSuccess = $this->vote->update($id,$poll_id,$user_id,$option_id);

        if($updateSuccess){
            return "Option updated successfully";
        }else{
        return "Error: Failed to update the option";
        }
    }

    public function delete() {
        $id = $_POST['id'] ?? null;
        if (!$id) {
            return "Error: 'id' is required.";
        }
        
        $deleteSuccess = $this->vote->delete($id);
        
        if ($deleteSuccess) {
            return "Option successfully deleted.";
        } else {
            return "Error: Failed to delete the option.";
        }
    }
    
    public function find() {
        $id = $_POST['id'] ?? null;
        
        if (!$id) {
            return "Error: 'id' is required.";
        }
        
        $findSuccess = $this->vote->find($id);
        return $findSuccess;
    }
}

?>
