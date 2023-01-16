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

    public function getMyReservations($id_user){
        $req = DatabaseModel::getModel()->getBD()->prepare('SELECT "Appointement".nb_student, "Appointement".student_level, start, "end", title, "desc" FROM "Appointement" INNER JOIN "Activities" A on "Appointement".id_activity = A.id INNER JOIN "Stand" S on A.stand = S.id WHERE id_user=:id_user');
        $req->bindValue(":id_user", $id_user);
        $req->execute();
        $rs = $req->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }


    public function getReservation($id_user,$id_activity): ?Reservation
    {
        if (!$this->isInDatabase($id_user,$id_activity)) {
            return null;
        }
        $req = DatabaseModel::getModel()->getBD()->prepare('SELECT id_user, email, nb_student, student_level, id_activity  FROM "Appointement" natural join "PersonalData" WHERE id_user=:id_user AND id_activity = :id_activity');
        $req->bindValue(":id_user", $id_user);
        $req->bindValue(":id_activity", $id_activity);
        $req->execute();
        $rs = $req->fetch(PDO::FETCH_ASSOC);
        if (!$rs) {
            return null;
        }
        return $this->buildReservation($rs);
    }

    public function getReservationByActivity($id_activity): array
    {
        $req = DatabaseModel::getModel()->getBD()->prepare('SELECT id_user, email, nb_student, student_level, id_activity  FROM "Appointement" natural join "PersonalData" WHERE id_activity = :id_activity');
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
        $req = DatabaseModel::getModel()->getBD()->prepare('SELECT id_user, email, nb_student, student_level, id_activity  FROM "Appointement" natural join "PersonalData" WHERE id_user = :id_user');
        $req->bindValue(":id_user", $id_user);
        $req->execute();
        $rs = $req->fetchAll(PDO::FETCH_ASSOC);
        $res = [];
        foreach ($rs as $reser){
            $res[] = $this->buildReservation($reser);
        }
        return $res;
    }

    public function getReservationByStand($id){
        $req = DatabaseModel::getModel()->getBD()->prepare('SELECT  a.id_user, p.email, a.nb_student, a.student_level, a.id_activity FROM "Activities" as act natural join "Appointement" as a natural join "PersonalData" as p WHERE act.stand = :id');
        $req->bindValue(":id", $id);
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
        if(isset($rs['email'])){
            $res->setEmail($rs['email']);
        }
        if(isset($rs['nb_student'])){
            $res->setNbStudent($rs['nb_student']);
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