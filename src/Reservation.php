<?php

class Reservation
{

    private $id_user ;


    private $nb_student;

    private $student_level;

   private $activity;


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


    public function getActivity()
    {
        return $this->activity;
    }


    public function setActivity($activity): void
    {
        $this->activity = $activity;
    }





}