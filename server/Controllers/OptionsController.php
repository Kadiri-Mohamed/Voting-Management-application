<?php

include './../Models/Options.php';

class OptionsController {
    private $option; 

    /** 
     * @fonction __construct
     * @description Initialise un objet Options pour l'utiliser dans les méthodes suivantes.
     * @param Aucun
     * @return void
     */
    
    public function __construct() {
        $this->option = new Options(); 
    }

    /** 
     * @fonction index
     * @description Récupère toutes les options disponibles depuis le modèle Options.
     * @param Aucun
     * @return mixed Retourne toutes les options.
     */

    public function index() {
        $data = $this->option->getAll(); 
        return $data;
    }

    /** 
     * @fonction add
     * @description Ajoute une nouvelle option à un sondage.
     * @param Aucun
     * @return string Retourne un message de succès ou une erreur selon l'état de l'ajout de l'option.
     */

    public function add(){
        $option = $POST_['option'] ?? null;
        $poll = $POST_['poll'] ?? null;

        if (!$option) {
           return "Error: 'option' is required.";
        }
        if (!$poll) {
           return "Error: 'poll' is required.";
        }

        $addSuccess=$this->option->add($option,$poll);
        
        if($addSuccess){
            return "Option add successfully";
        }else{
            return "Error: Failed to add the option";
        }
    }
    
    /** 
     * @fonction update
     * @description Met à jour les informations d'une option existante.
     * @param Aucun
     * @return string Retourne un message de succès ou une erreur selon l'état de la mise à jour de l'option.
     */

    public function update(){
        $id = $POST_['id']?? null;
        $poll_id = $POST_['poll_id']?? null;
        $option_text = $POST_['option_text']?? null;

        if (!$id) {
            return "Error: 'id' is required.";
        }
        if (!$poll_id) {
            return "Error: 'poll_id' is required.";
        }
        if (!$option_text) {
            return "Error: 'option_text' is required.";
        }

        $updateSuccess = $this->option->update($id,$poll_id,$option_text);

        if($updateSuccess){
            return "Option updated successfully";
        }else{
        return "Error: Failed to update the option";
        }
    }

     /** 
     * @fonction delete
     * @description Supprime une option existante en fonction de son ID.
     * @param Aucun
     * @return string Retourne un message de succès ou une erreur selon l'état de la suppression de l'option.
     */

    public function delete() {
        $id = $_POST['id'] ?? null;
        if (!$id) {
            return "Error: 'id' is required.";
        }
        
        $deleteSuccess = $this->option->delete($id);
        
        if ($deleteSuccess) {
            return "Option successfully deleted.";
        } else {
            return "Error: Failed to delete the option.";
        }
    }
    
    /** 
     * @fonction find
     * @description Recherche une option spécifique en fonction de son ID.
     * @param Aucun
     * @return mixed Retourne les informations de l'option trouvée ou une erreur si l'ID est manquant.
     */

    public function find() {
        $id = $_POST['id'] ?? null;
        
        if (!$id) {
            return "Error: 'id' is required.";
        }
        
        $findSuccess = $this->option->find($id);
        return $findSuccess;
    }
}


