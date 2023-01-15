<?php

class ReservationController extends Controller
{

    public function action_default()
    {
        // TODO: Implement action_default() method.
    }

    public function action_filter()
    {
        $filtre = ['level' => $_POST["stud_level"],'start' => $_POST["meeting-time_start"],'end' => $_POST["meeting-time"],'nb'=> $_POST["stud_number"]];
        var_dump($filtre);
        echo $filtre["level"];
        /*$this->render("myAccount",['stand' => StandModel::getModel()->getAllStand(), 'filtre' => $filtre]);*/
    }
}