<?php

class StandModel
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

    public function isInDatabase($id){
        $req = DatabaseModel::getModel()->getBD()->prepare('SELECT id FROM "Stand" WHERE id= :id');
        $req->bindValue(":id", $id);
        $req->execute();
        $rs = $req->fetch();
        if($rs){
            return true;
        }

        return false;
    }

    public function getStand($id){
        if(!$this->isInDatabase($id)){
            return null;
        }
        $req = DatabaseModel::getModel()->getBD()->prepare('SELECT * FROM "Stand" WHERE id=:id');
        $req->bindValue(":id", $id);
        $req->execute();
        $rs = $req->fetch(PDO::FETCH_ASSOC);
        if(!$rs){
            return null;
        }
        $activities = ActivitiesModel::getModel()->getAllActivitiesByStand($id);
        $reservations = ReservationModel::getModel()->getReservationByStand($id);
        foreach($activities as $activity){
            foreach ($reservations as $reservation){
                if($reservation->getIdActivity() == $activity->getId()){
                    $activity->setReservations($reservation);
                }
            }
        }
        return $this->buildStand($rs, $activities);
    }

    public function getAllStand(){
        $allStand = [];
        $id = 1;
        $max = $this->maxStand();
        while ($id<=$max){
            if($this->isInDatabase($id)){
                $allStand["$id"] = $this->getStand($id);
                $id += 1;
            }
        }
        return $allStand;
    }

    public function maxStand(){
        $req = DatabaseModel::getModel()->getBD()->prepare('SELECT "id" FROM "Stand" ORDER BY "id" desc');
        $req->execute();
        $id = $req->fetch(PDO::FETCH_ASSOC);
        return $id["id"];
    }

    public function create($stand){
        if(!$this->isInDatabase($stand->getId())){
            $req = DatabaseModel::getModel()->getBD()->prepare('INSERT INTO "Stand" (id,title, "desc") VALUES (:id,:title, :desc)');
            $req->bindValue(":id", $stand->getId());
            $req->bindValue(":title", $stand->getTitle());
            $req->bindValue(":desc", $stand->getDesc());
            $req->execute();
        }
    }

    public function fetchStandsFromJson(){
        return getJson("../plann_stand.json");
    }

    public function generateStands(){
        $file = $this->fetchStandsFromJson();
        $tab = [];
        foreach ($file as $value){
            $stand = $this->buildStand($value, null);
            $tab[]=$stand;
            $this->create($stand);
        }
        return $tab;
    }

    public function buildStand($rs, $activities){
        $stand = new Stand();
        if(isset($rs['id'])){
            $stand->setId($rs['id']);
        }
        if(isset($rs['title'])){
            $stand->setTitle($rs['title']);
        }
        if(isset($rs['desc'])){
            $stand->setDesc($rs['desc']);
        }
        if(isset($rs['student_level'])){
            $stand->setStudentLevel($rs['student_level']);
        }
        if(isset($rs['capacity'])){
            $stand->setCapacity($rs['capacity']);
        }
        if(isset($rs['nbAnim_jeudi'])){
            $stand->setNbAnimJeudi($rs['nbAnim_jeudi']);
        }
        if(isset($rs['nbAnim_vendredi'])){
            $stand->setNbAnimVendredi($rs['nbAnim_vendredi']);
        }
        if(isset($rs['duree'])){
            $stand->setDuree($rs['duree']);
        }
        if(isset($rs['inter'])){
            $stand->setInter($rs['inter']);
        }
        if(isset($rs['pause_start'])){
            $stand->setPauseStart($rs['pause_start']);
        }
        if(isset($rs['pause_end'])){
            $stand->setPauseEnd($rs['pause_end']);
        }
        if(isset($activities)){
            $stand->setActivities($activities);
        }
        return $stand;
    }
}