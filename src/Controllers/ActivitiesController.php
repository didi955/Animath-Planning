<?php

class ActivitiesController extends Controller
{

    /**
     * @inheritDoc
     */
    public function action_default()
    {
        // TODO: Implement action_default() method.
    }

    public function action_create(){
        if(isset($_POST['debut']) && isset($_POST['fin']) && isset($_POST['niveau']) && isset($_POST['capacity']) && isset($_GET['id'])){
            $debut = $_POST['debut'];
            $fin = $_POST['fin'];
            $niveau = $_POST['niveau'];
            $capacity = $_POST['capacity'];
            $id = $_GET['id'];
            $stand = StandModel::getModel()->getStand($id);
            if($stand == null){
                $this->action_error("Le stand n'existe pas", 444);
                return;
            }
            if($debut == null || $fin == null || $niveau == null || $capacity == null){
                $this->action_error("Veuillez remplir tous les champs", 444);
                return;
            }
            if($debut > $fin){
                $this->action_error("La date de début doit être inférieure à la date de fin", 444);
                return;
            }
            if($capacity < 0){
                $this->action_error("La capacité doit être supérieure ou égale à 0", 444);
                return;
            }
            $activity = new Activities();
            $activity->setStart($debut);
            $activity->setEnd($fin);
            $activity->setStudentLevel($niveau);
            $activity->setCapacity($capacity);
            $activity->setStand($stand);
            ActivitiesModel::getModel()->create($activity);
            $this->action_gestion();
        }
        else {
            $this->action_error("Veuillez remplir tous les champs", 444);
        }
    }

}