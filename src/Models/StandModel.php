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

    public function getStand(string $id){
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
        $activities = null;
        if ($activities != null) {
            $activities = ActivitiesModel::getModel()->getAllDataByStand($id);
        }
        return $this->buildStand($rs, $activities);
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
            $stand->setActivities($rs['activities']);
        }
        return $stand;
    }
}