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

    // TODO: Changer PDOException par Exception perso
    public function action_generate(){

        if(isset($_SESSION['user']) && unserialize($_SESSION['user'])->getRole() === Role::SUPERVISOR) {
            $datas = [];
            try {
                ActivitiesModel::getModel()->generateActivities();
            }
            catch (PDOException $exception){
                $datas['err'] = $exception->getMessage();
            }
            if(isset($stands)){
                $datas['stands'] = $stands;
            }
            else
            {
                $datas['stands'] = StandModel::getModel()->getAllStand();
            }
            $this->render('gestion', $datas);
        }
        else {
            $this->action_error("Vous n'avez pas les droits effectuer cette action");
        }
    }

    public function action_create(){
        if(isset($_POST['debut']) && isset($_POST['fin']) && isset($_POST['niveau']) && isset($_POST['capacity']) && isset($_POST['id']) && isset($_SESSION['user'])){
            $user = unserialize($_SESSION['user']);
            if(!($user->getRole() === Role::SUPERVISOR)){
                $this->action_error("Vous n'avez pas les droits pour effectuer cette action");
                return;
            }
            $debut = $_POST['debut'];
            $fin = $_POST['fin'];
            $niveau = $_POST['niveau'];
            $capacity = $_POST['capacity'];
            $id = $_POST['id'];
            $date_debut = date("Y-m-d H:i", strtotime($debut));
            $date_fin = date("Y-m-d H:i", strtotime($fin));
            if($date_debut > $date_fin){
                $this->action_error("La date de début doit être inférieure à la date de fin");
                return;
            }
            $stand = StandModel::getModel()->getStand($id);
            if($stand == null){
                $this->action_error("Le stand n'existe pas");
                return;
            }
            if($debut == null || $fin == null || $niveau == null || $capacity == null){
                $this->action_error("Veuillez remplir tous les champs");
                return;
            }
            if($debut > $fin){
                $this->action_error("La date de début doit être inférieure à la date de fin");
                return;
            }
            if($capacity < 0){
                $this->action_error("La capacité doit être supérieure ou égale à 0");
                return;
            }
            $activity = new Activities();
            $activity->setStart($debut);
            $activity->setEnd($fin);
            $activity->setStudentLevel($niveau);
            $activity->setCapacity($capacity);
            $activity->setStand($stand);
            ActivitiesModel::getModel()->create($activity);
            $this->render('gestion', ['stands' => StandModel::getModel()->getAllStand()]);
        }
        else {
            $this->action_error("Veuillez remplir tous les champs");
        }
    }

    public function action_remove(){
        if(isset($_POST['id'])){
            ActivitiesModel::getModel()->remove($_POST['id']);
        }
        $this->render('gestion', ['stands' => StandModel::getModel()->getAllStand(), 'user' => unserialize($_SESSION['user'])]);
    }

}