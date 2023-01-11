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
        return $this->buildStand($rs, $activities);
    }

    public function getAllStand(){
        $allStand = [];
        $id = 1;
        while ($id<=self::getModel()->maxStand()){
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
            $req = DatabaseModel::getModel()->getBD()->prepare('INSERT INTO "Stand" (id_user, title, "desc") VALUES (:id_user, :title, :desc)');
            $req->bindValue(":id_user", $stand->getIdUser());
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
        foreach ($file as $value){
            $stand = $this->buildStand($value, null);
            $this->create($stand);
        }
    }

    public function buildStand($rs, $activities){
        $stand = new Stand();
        if(isset($rs['id'])){
            $stand->setId($rs['id']);
        }
        if(isset($rs['id_user'])){
            $stand->setIdUser($rs['id_user']);
        }
        if(isset($rs['title'])){
            $stand->setTitle($rs['title']);
        }
        if(isset($rs['desc'])){
            $stand->setDesc($rs['desc']);
        }
        if(isset($activities)){
            $stand->setActivities($activities);
        }
        return $stand;
    }
}