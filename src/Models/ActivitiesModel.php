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
    public function generateActivities(){
        $tab = StandModel::getModel()->fetchStandsFromJson();
        $datedep1= new DateTime("2023-05-25T09:00");
        $datedep= new DateTime("2023-05-25T09:00");
        $datearr = new DateTime("2023-05-25T18:00");
        foreach($tab as $cle=>$val){
            $debutpause = new DateTime("2023-05-25T$val[pause_start]");
            $finpause = new DateTime("2023-05-25T$val[pause_end]");
            $finpause1 = new DateTime("2023-05-25T$val[pause_end]");
            $id = $cle + 1;
            $date = $datedep1;
            $datefin = $datedep;
            while ($datefin < $datearr) {
                if ($datefin < $debutpause) {
                    $datefin = date_add($datefin, date_interval_create_from_date_string("$val[duree] minutes"));
                    echo "<p> Date début = " . $date->format("Y-m-d H:i") . "   Date fin = " . $datefin->format("Y-m-d H:i") . "</p>";
                    $act = new Activities();
                    $act->setId(null);
                    $act->setStand($id);
                    $act->setStart($date->format("Y-m-dTH:i"));
                    $act->setEnd($datefin->format("Y-m-dTH:i"));
                    $act->setStudentLevel($val["student_level"]);
                    $act->setCapacity($val["capacity"]);
                    $this->create($act);

                }
                else {
                    $date= $finpause;
                    $datefin= $finpause1;
                    $datefin= date_add($datefin, date_interval_create_from_date_string("$val[duree] minutes"));
                    echo "<p> Date début = " . $date->format("Y-m-d H:i") . "   Date fin = " . $datefin->format("Y-m-d H:i") . "</p>";
                    $act = new Activities();
                    $act->setId(null);
                    $act->setStand($id);
                    $act->setStart($date->format("Y-m-dTH:i"));
                    $act->setEnd($datefin->format("Y-m-dTH:i"));
                    $act->setStudentLevel($val["student_level"]);
                    $act->setCapacity($val["capacity"]);
                    $this->create($act);
                }
                $date = date_add($date, date_interval_create_from_date_string("$val[duree] minutes"));
                $date = date_add($date, date_interval_create_from_date_string("$val[inter] minutes"));
                $datefin = date_add($datefin, date_interval_create_from_date_string("$val[inter] minutes"));
            }
        }
    }

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