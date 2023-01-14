<?php

class ReservationModel
{
    private static $instance = null;

    private function __construct()
    {
    }

    public static function getModel()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getReservation($id_user)
    {
        if (!$this->isInDatabase($id_user)) {
            return null;
        }
        $req = DatabaseModel::getModel()->getBD()->prepare('SELECT * FROM "Appointement" WHERE id_user=:id_user');
        $req->bindValue(":id_user", $id_user);
        $req->execute();
        $rs = $req->fetch(PDO::FETCH_ASSOC);
        if (!$rs) {
            return null;
        }
        $activities = ActivitiesModel::getModel()->getAllActivitiesByStand($id_user);
        return $this->buildStand($rs, $activity);
    }


    public function isInDatabase($id_user,$id_activity)
    {
        $req = DatabaseModel::getModel()->getBD()->prepare('SELECT id FROM "Appointement" WHERE id_user= :id_user AND id_activity = :id_activity');
        $req->bindValue(":id_user", $id_user);
        $req->bindValue(":id_activity", $id_activity);
        $req->execute();
        $rs = $req->fetch();
        if ($rs) {
            return true;
        }
        return false;
    }

}