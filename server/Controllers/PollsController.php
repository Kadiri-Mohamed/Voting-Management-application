<?php

include './../Models/Polls.php';

class PollsController {
    private $poll; 

    public function __construct() {
        $this->polls = new Polls(); 
    }

    public function index() {
        $data = $this->polls->getAll(); 
        return $data;
    }

    public function add(){
        $title = $POST_['title'] ?? null;
        $description = $POST_['description'] ?? null;
        $created = $POST_['created'] ?? null;
        $shareable = $POST_['shareable'] ?? null;
        $public = $POST_['public'] ?? null;

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
            return "Error: 'share$shareable' is required.";
        }
        if (!$public) {
            return "Error: 'public' is required.";
        }
        
        $addSuccess=$this->poll->add($title,$description,$created,$shareable,$public);
        if($addSuccess){
            return "Option add successfully";
        }else{
            return "Error: Failed to add the option";
        }
    }
    
    public function update(){
        $id=$POST_['id'];
        $title = $POST_['title'] ?? null;
        $description = $POST_['description'] ?? null;
        $created = $POST_['created'] ?? null;
        $shareable = $POST_['shareable'] ?? null;
        $public = $POST_['public'] ?? null;

        if(!$id){
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
            return "Error: 'share$shareable' is required.";
        }
        if (!$public) {
            return "Error: 'public' is required.";
        }
        
        $updateSuccess=$this->poll->update($title,$description,$created,$shareable,$public);
        if($updateSuccess){
            return "Option update successfully";
        }else{
            return "Error: Failed to update the option";
        }
    }
    public function delete() {
        $id = $_POST['id'] ?? null;
        if (!$id) {
            return "Error: 'id' is required.";
        }
        
        $deleteSuccess = $this->poll->delete($id);
        
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
        
        $findSuccess = $this->poll->find($id);
        return $findSuccess;
    }
}

?>
