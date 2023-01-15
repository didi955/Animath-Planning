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

    public function getReservation($id_user,$id_activity): ?Reservation
    {
        if (!$this->isInDatabase($id_user,$id_activity)) {
            return null;
        }
        $req = DatabaseModel::getModel()->getBD()->prepare('SELECT * FROM "Appointement" WHERE id_user=:id_user AND id_activity = :id_activity');
        $req->bindValue(":id_user", $id_user);
        $req->bindValue(":id_activity", $id_activity);
        $req->execute();
        $rs = $req->fetch(PDO::FETCH_ASSOC);
        if (!$rs) {
            return null;
        }
        $activity = ActivitiesModel::getModel()->getActivities($id_activity);
        return $this->buildReservation($rs);
    }

    public function getReservationByActivity($id_activity): array
    {
        $req = DatabaseModel::getModel()->getBD()->prepare('SELECT * FROM "Appointement" WHERE id_activity = :id_activity');
        $req->bindValue(":id_activity", $id_activity);
        $req->execute();
        $rs = $req->fetchAll(PDO::FETCH_ASSOC);
        $res = [];
        foreach ($rs as $reser){
            $res[] = $this->buildReservation($reser);
        }
        return $res;
    }

    public function getReservationByUserId($id_user): array
    {
        $req = DatabaseModel::getModel()->getBD()->prepare('SELECT * FROM "Appointement" WHERE id_user = :id_user');
        $req->bindValue(":id_user", $id_user);
        $req->execute();
        $rs = $req->fetchAll(PDO::FETCH_ASSOC);
        $res = [];
        foreach ($rs as $reser){
            $res[] = $this->buildReservation($reser);
        }
        return $res;
    }

    public function isInDatabase($id_user,$id_activity): bool
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

    private function buildReservation($rs): Reservation
    {
        $res = new Reservation();
        if(isset($rs['id_user'])){
            $res->setIdUser($rs['id_user']);
        }
        if(isset($rs['nb_student'])){
            $res->setNbStudent($rs['NbStudent']);
        }
        if(isset($rs['student_level'])){
            $res->setStudentLevel($rs['student_level']);
        }
        if(isset($rs['id_activity'])){
            $res->setIdActivity($rs['id_activity']);
        }
        return $res;
    }
}