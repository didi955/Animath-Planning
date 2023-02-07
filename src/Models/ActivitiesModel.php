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

    public function getRemainingCapacity($id_activity){
        $sql = 'SELECT capacity - COALESCE(SUM(nb_student), 0) as remaining_capacity FROM "Activities"
    LEFT JOIN "Appointement" ON "Activities".id = "Appointement".id_activity WHERE "Activities".id = :id_activity
    GROUP BY capacity';
        $req = DatabaseModel::getModel()->getBD()->prepare($sql);
        $req->bindValue(":id_activity", $id_activity);
        $req->execute();
        $rs = $req->fetch(PDO::FETCH_ASSOC);
        return $rs['remaining_capacity'];
    }

    public function getActivitiesWithFilter($filter)
    {
        $sql = 'SELECT title, "desc", "Activities".id, stand, start, "end", "Activities".student_level alevel, capacity, ("Activities".capacity - (SELECT SUM(nb_student) FROM "Appointement" WHERE id_activity = "Activities".id)) as remaining_capacity
FROM "Activities" JOIN "Stand" S on S.id = "Activities".stand
WHERE "Activities".student_level LIKE :level AND start >= :start_time AND "end" <= :end_time';
        $params = [
            ':level' => "%" . $filter['student_level'] . "%",
            ':start_time' => $filter['start'],
            ':end_time' => $filter['end']
        ];
        $req = DatabaseModel::getModel()->getBD()->prepare($sql);
        $req->bindValue(':level', $params[':level']);
        $req->bindValue(':start_time', $params[':start_time']);
        $req->bindValue(':end_time', $params[':end_time']);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getActivities($id, bool $want_reservations = true){
        $req = DatabaseModel::getModel()->getBD()->prepare('SELECT * FROM "Activities" WHERE id=:id');
        $req->bindValue(":id", $id);
        $req->execute();
        $rs = $req->fetch(PDO::FETCH_ASSOC);
        if(!$rs){
            return null;
        }
        if($want_reservations === false){
            return $this->buildActivitiesWoRes($rs);
        }
        return $this->buildActivities($rs,ReservationModel::getModel()->getReservationByActivity($id));
    }

    public function getAllActivitiesByStand($stand){
        $req = DatabaseModel::getModel()->getBD()->prepare('SELECT * FROM "Activities" WHERE stand=:stand');
        $req->bindValue(":stand", $stand);
        $req->execute();
        $rs = $req->fetchAll(PDO::FETCH_ASSOC);
        $acts = [];
        foreach ($rs as $act){
            $acts[]=$this->buildActivitiesWoRes($act);
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
            set_time_limit(10);
            $date = DateUtil::create("2023-05-25",9,0);
            $datefin = DateUtil::create("2023-05-25",9,0);
            $nbanimjeudi = $val->getNbAnimJeudi();
            for($i = 0;$i<$nbanimjeudi;$i++){
                $date->default();
                $datefin->default();
                while ($datefin->compare("18:00")===-1){
                    $datefin->addMin($val->getDuree());
                    if ($date->isValid($val->getPauseStart(),$val->getPauseEnd()) and $datefin->isValid($val->getPauseStart(),$val->getPauseEnd()) and !$date->isInterval($datefin,$val->getPauseStart(),$val->getPauseEnd())) {
                        $act = ['stand' => $val->getId(), 'start' => $date->format(), 'end' => $datefin->format(), 'student_level' => $val->getStudentLevel(), 'capacity' => intdiv($val->getCapacity(),$nbanimjeudi)];
                        $activities[] = self::getModel()->buildActivitiesWoRes($act);
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
            $date2 = DateUtil::create("2023-05-26",9,0);
            $datefin2 = DateUtil::create("2023-05-26",9,0);
            $nbanimvendredi = $val->getNbAnimVendredi();
            for($i = 0;$i<$nbanimvendredi;$i++){
                $date2->default();
                $datefin2->default();
                while ($datefin2->compare("18:00")===-1){
                    $datefin2->addMin($val->getDuree());
                    if ($date2->isValid($val->getPauseStart(),$val->getPauseEnd()) and $datefin2->isValid($val->getPauseStart(),$val->getPauseEnd()) and !$date2->isInterval($datefin2,$val->getPauseStart(),$val->getPauseEnd())) {
                        $act = ['stand' => $val->getId(), 'start' => $date2->format(), 'end' => $datefin2->format(), 'student_level' => $val->getStudentLevel(), 'capacity' => intdiv($val->getCapacity(),$nbanimvendredi)];
                        $activities[] = self::getModel()->buildActivitiesWoRes($act);
                        $date2->addMin($val->getDuree());
                        $date2->addMin($val->getInter());
                        $datefin2->addMin($val->getInter());
                    }
                    else{
                        $date2->default($val->getPauseEnd());
                        $datefin2->default($val->getPauseEnd());
                    }
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

    private function buildActivities($rs, $res)
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
        if(isset($res)){
            $activities->setReservations($res);
        }
        return $activities;
    }

    private function buildActivitiesWoRes($rs)
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

    public function remove($id)
    {
        $req = DatabaseModel::getModel()->getBD()->prepare('DELETE FROM "Activities" where id=:id');
        $req->bindValue(":id",$id);
        $req->execute();
    }

}