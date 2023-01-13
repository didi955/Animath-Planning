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
        try {
            $stands = StandModel::getModel()->generateStands();
        }
        catch (PDOException){
            throw new PDOException("Problème de chargement");
        }
        $activities = [];
        $debut = "09:00";
        $fin = "18:00";
        foreach($stands as $val){
            $date = DateUtil::create("2023-05-25",9,0);
            $datefin = DateUtil::create("2023-05-25",9,0);
            while ($datefin->compare("18:00")===-1) {
                $datefin->addMin($val->getDuree());
                if ($date->isValid($val->getPauseStart(),$val->getPauseEnd()) and $datefin->isValid($val->getPauseStart(),$val->getPauseEnd()) and !$date->isInterval($datefin,$val->getPauseStart(),$val->getPauseEnd())) {
                    $act = ['stand' => $val->getId(), 'start' => $date->format(), 'end' => $datefin->format(), 'student_level' => $val->getStudentLevel(), 'capacity' => $val->getCapacity()];
                    $activities[] = self::getModel()->buildActivities($act);
                    $date->addMin($val->getDuree());
                    $date->addMin($val->getInter());
                    $datefin->addMin($val->getInter());
                }
                else{
                    $date->default($val->getPauseEnd());
                    $datefin->default($val->getPauseEnd());
                }
            }
        }
        foreach($activities as $activity){
            try {
                $this->create($activity);
            }
            catch (PDOException){
                throw new PDOException("Problème de chargement");
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