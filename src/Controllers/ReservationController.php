<?php

class ReservationController extends Controller
{

    public function action_default()
    {
        // TODO: Implement action_default() method.
    }

    public function action_filter()
    {
        if(!isset($_SESSION['user'])){
            $this->render('home');
        }
        if(isset($_POST['stud_level']) && isset($_POST['meeting-time_start']) && isset($_POST['meeting-time_end']) && isset($_POST['stud_number'])){
            $filtre = ['student_level' => $_POST["stud_level"], 'start' => $_POST["meeting-time_start"], 'end' => $_POST["meeting-time_end"], 'nb_student'=> $_POST["stud_number"]];
            $activities = ActivitiesModel::getModel()->getActivitiesWithFilter($filtre);
            $this->render("myAccount",['user' => unserialize($_SESSION['user']), 'stand' => StandModel::getModel()->getAllStand(), 'activities' => $activities]);
        }
        else {
            $this->action_error("Veuillez remplir tous les champs");
        }
    }
}