<?php

class Activities
{
    private $id;

    private $stand;

    private $start;

    private $end;

    private $student_level;

    private $capacity;

    private $reservations;

    public function __construct()
    {
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getStand()
    {
        return $this->stand;
    }

    public function setStand($stand): void
    {
        $this->stand = $stand;
    }

    public function getStart()
    {
        return $this->start;
    }

    public function setStart($start): void
    {
        $this->start = $start;
    }

    public function getEnd()
    {
        return $this->end;
    }

    public function setEnd($end): void
    {
        $this->end = $end;
    }

    public function getStudentLevel()
    {
        return $this->student_level;
    }

    public function setStudentLevel($student_level): void
    {


        $this->student_level = $student_level;
    }

    public function getCapacity()
    {
        return $this->capacity;
    }

    public function setCapacity($capacity): void
    {
        $this->capacity = $capacity;
    }

    public function getReservations()
    {
        return $this->reservations;
    }

    public function setReservations($reservations): void
    {
        $this->reservations = $reservations;
    }

}