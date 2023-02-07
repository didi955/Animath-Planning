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
        if(isset($_POST['stud_level']) && isset($_POST['meeting-time_start']) && isset($_POST['meeting-time_end'])){
            $filtre = ['student_level' => $_POST["stud_level"], 'start' => $_POST["meeting-time_start"], 'end' => $_POST["meeting-time_end"]];
            $activities = ActivitiesModel::getModel()->getActivitiesWithFilter($filtre);
            $this->render("myAccount",['user' => unserialize($_SESSION['user']), 'stand' => StandModel::getModel()->getAllStand(), 'activities' => $activities, 'student_level' => $_POST['stud_level'],  'appointements' => ReservationModel::getModel()->getMyReservations(unserialize($_SESSION['user'])->getID())]);
        }
        else {
            $this->action_error("Veuillez remplir tous les champs");
        }
    }

    public function action_booking(){
        if(unserialize($_SESSION['user'])->getRole() === Role::PROFESSOR && isset($_POST['id_activity']) && isset($_POST['nb_student']) && isset($_POST['student_level'])){
            $activity_id = $_POST['id_activity'];
            if(!ReservationModel::getModel()->isInDatabase(unserialize($_SESSION['user'])->getId(), $activity_id)){
                if(ActivitiesModel::getModel()->getRemainingCapacity($activity_id) >= $_POST['nb_student']){
                    ReservationModel::getModel()->addReservation(unserialize($_SESSION['user'])->getId(), $activity_id, $_POST['nb_student'], $_POST['student_level']);
                    $this->render("myAccount",['user' => unserialize($_SESSION['user']), 'stand' => StandModel::getModel()->getAllStand(), 'appointements' => ReservationModel::getModel()->getMyReservations(unserialize($_SESSION['user'])->getID())]);
                }
                else {
                    $this->action_error("Il n'y a plus assez de place pour cette activité");
                }
            }
            else {
                $this->action_error("Vous avez déjà réservé cette activité");
            }
        }
    }


}