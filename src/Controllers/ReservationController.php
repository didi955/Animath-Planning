<?php

class ReservationController extends Controller
{

    public function action_default()
    {
        // TODO: Implement action_default() method.
    }

    public function action_filter()
    {
        $filtre = ['level' => $_GET["stud_level"],'start' => $_GET["meeting-time_start"],'end' => $_GET["meeting-time"],'nb'=> $_GET["stud_number"]];
        var_dump($filtre);
        echo $filtre["level"];
        /*$this->render("myAccount",['stand' => StandModel::getModel()->getAllStand(), 'filtre' => $filtre]);*/
    }
}