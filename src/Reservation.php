
<?php

class Reservation
{
private $id_user ;

private $id_activity;

private $nb_student;

private $student_level;

private $start;

private $end;

private $debut;

private $fin;

public function __construct()
{

}

    public function getIdUser()
    {
        return $this->id_user;
    }

    public function setIdUser($id_user): void
    {
        $this->id_user = $id_user;
    }


    public function getIdActivity()
    {
        return $this->id_activity;
    }


    public function setIdActivity($id_activity): void
    {
        $this->id_activity = $id_activity;
    }


    public function getNbStudent()
    {
        return $this->nb_student;
    }


    public function setNbStudent($nb_student): void
    {
        $this->nb_student = $nb_student;
    }


    public function getStudentLevel()
    {
        return $this->student_level;
    }


    public function setStudentLevel($student_level): void
    {
        $this->student_level = $student_level;
    }


    public function getStart()
    {
        return $this->start;
    }


    public function getEnd()
    {
        return $this->end;
    }


    public function getDebut()
    {
        return $this->debut;
    }


    public function setDebut($debut): void
    {
        $this->debut = $debut;
    }


    public function getFin()
    {
        return $this->fin;
    }


    public function setFin($fin): void
    {
        $this->fin = $fin;
    }



}