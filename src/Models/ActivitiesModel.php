<?php

class ActivitiesModel
{

    private static $instance = null;

    private function __construct(){

    }

    public static function getModel()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getActivities($id){
        $req = DatabaseModel::getModel()->getBD()->prepare('SELECT * FROM "Activities" WHERE id=:id');
        $req->bindValue(":id", $id);
        $req->execute();
        $rs = $req->fetch(PDO::FETCH_ASSOC);
        if(!$rs){
            return null;
        }
        return $this->buildActivities($rs);
    }

    public function getAllActivitiesByStand($stand){
        $req = DatabaseModel::getModel()->getBD()->prepare('SELECT * FROM "Activities" WHERE stand=:stand');
        $req->bindValue(":stand", $stand);
        $req->execute();
        $rs = $req->fetchAll(PDO::FETCH_ASSOC);
        $acts = [];
        $i=0;
        foreach ($rs as $act){
            $acts["$i"]=$this->buildActivities($act);
            $i += 1;
        }
        return $acts;
    }

    public function create($activity){
        if(!$this->getActivities($activity->getId()) || $activity->getId() == null){
            $req = DatabaseModel::getModel()->getBD()->prepare('INSERT INTO "Activities" (start, "end", student_level, capacity, stand) VALUES (:debut, :fin, :niveau, :capacity, :stand)');
            $req->bindValue(":debut", $activity->getStart());
            $req->bindValue(":fin", $activity->getEnd());
            $req->bindValue(":niveau", $activity->getStudentLevel());
            $req->bindValue(":capacity", $activity->getCapacity());
            $req->bindValue(":stand", $activity->getStand());
            $req->execute();
        }
    }

    // TODO NEED REWORK
    /*public function generateActivities(){
        $stands = StandModel::getModel()->generateStands();
        $activities = [];
        $datedep1= new DateTime("2023-05-25T09:00");
        $datedep= new DateTime("2023-05-25T09:00");
        $datearr = new DateTime("2023-05-25T18:00");
        $i = 1;
        foreach($stands as $val){
            $debutpause = new DateTime("2023-05-25T".$val->getPauseStart());
            $finpause = new DateTime("2023-05-25T".$val->getPauseEnd());
            $finpause1 = new DateTime("2023-05-25T".$val->getPauseEnd());
            $date = $datedep1;
            $datefin = $datedep;
            while ($datefin < $datearr) {
                if ($datefin >= $debutpause) {
                    $date = $finpause;
                    $datefin = $finpause1;
                }
                $datefin = date_add($datefin, date_interval_create_from_date_string($val->getDuree()." minutes"));
                $act = ['stand' => $i,'start' => $date->format("Y-m-dTH:i"), 'end' => $datefin->format("Y-m-dTH:i"), 'student_level' => $val->getStudentLevel(), 'capacity'=> $val->getCapacity()];
                $i += 1;
                $activities[] = self::getModel()->buildActivities($act);
                $date = date_add($date, date_interval_create_from_date_string($val->getDuree()." minutes"));
                $date = date_add($date, date_interval_create_from_date_string($val->getInter()." minutes"));
                $datefin = date_add($datefin, date_interval_create_from_date_string($val->getInter()." minutes"));
            }
        }
        foreach($activities as $activity){
            $this->create($activity);
        }
    }*/

    private function buildActivities($rs)
    {
        $activities = new Activities();
        if(isset($rs['id'])){
            $activities->setId($rs['id']);
        }
        if(isset($rs['stand'])){
            $activities->setStand($rs['stand']);
        }
        if(isset($rs['start'])){
            $activities->setStart($rs['start']);
        }
        if(isset($rs['end'])){
            $activities->setEnd($rs['end']);
        }
        if(isset($rs['student_level'])){
            $activities->setStudentLevel($rs['student_level']);
        }
        if(isset($rs['capacity'])){
            $activities->setCapacity($rs['capacity']);
        }
        return $activities;
    }

}