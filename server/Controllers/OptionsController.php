<?php

include './../Models/Options.php';

class OptionsController {
    private $option; 

    /** 
     * @fonction __construct
     * @description Initialise un objet Options pour l'utiliser dans les méthodes suivantes.
     * @return void
     */
    
    public function __construct() {
        $this->option = new Options(); 
    }

    /** 
     * @fonction index
     * @description Récupère toutes les options disponibles depuis le modèle Options.
     * @return mixed Retourne toutes les options.
     */

    public function index() {
        $data = $this->option->getAll(); 
        return json_encode($data);
    }

    /** 
     * @fonction add
     * @description Ajoute une nouvelle option à un sondage.
     * @return string Retourne un message de succès ou une erreur selon l'état de l'ajout de l'option.
     */

    public function add(){
        $option = $_POST['option'] ?? null;
        $poll = $_POST['poll'] ?? null;

        if (!$option) {
           return json_encode(["error" => "'option' is required."]);
        }
        if (!$poll) {
           return json_encode(["error" => "'poll' is required."]);
        }

        $addSuccess = $this->option->create($poll ,$option );
        
        if ($addSuccess) {
            return json_encode(["message" => "Option added successfully"]);
        } else {
            return json_encode(["error" => "Failed to add the option"]);
        }
    }
    
    /** 
     * @fonction update
     * @description Met à jour les informations d'une option existante.
     * @return string Retourne un message de succès ou une erreur selon l'état de la mise à jour de l'option.
     */

    public function update(){
        $id = $_POST['id'] ?? null;
        $poll_id = $_POST['poll_id'] ?? null;
        $option_text = $_POST['option_text'] ?? null;

        if (!$id) {
            return json_encode(["error" => "'id' is required."]);
        }
        if (!$poll_id) {
            return json_encode(["error" => "'poll_id' is required."]);
        }
        if (!$option_text) {
            return json_encode(["error" => "'option_text' is required."]);
        }

        $updateSuccess = $this->option->update($id, $poll_id, $option_text);

        if ($updateSuccess) {
            return json_encode(["message" => "Option updated successfully"]);
        } else {
            return json_encode(["error" => "Failed to update the option"]);
        }
    }

     /** 
     * @fonction delete
     * @description Supprime une option existante en fonction de son ID.
     * @return string Retourne un message de succès ou une erreur selon l'état de la suppression de l'option.
     */

    public function delete() {
        $id = $_POST['id'] ?? null;
        if (!$id) {
            return json_encode(["error" => "'id' is required."]);
        }
        
        $deleteSuccess = $this->option->delete($id);
        
        if ($deleteSuccess) {
            return json_encode(["message" => "Option successfully deleted."]);
        } else {
            return json_encode(["error" => "Failed to delete the option."]);
        }
    }
    
    /** 
     * @fonction find
     * @description Recherche une option spécifique en fonction de son ID.
     * @return mixed Retourne les informations de l'option trouvée ou une erreur si l'ID est manquant.
     */

    public function find() {
        $id = $_POST['id'] ?? null;
        
        if (!$id) {
            return json_encode(["error" => "'id' is required."]);
        }
        
        $findSuccess = $this->option->find($id);
        return json_encode($findSuccess);
    }
}
