<?php

class Stand
{
    private $id;

    private $title;

    private $desc;

    private $student_level;

    private $capacity;

    private $nbAnim_jeudi;

    private $nbAnim_vendredi;

    private $duree;

    private $inter;

    private $pause_start;

    private $pause_end;

    private $activities;

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

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function getDesc()
    {
        return $this->desc;
    }

    public function setDesc($desc): void
    {
        $this->desc = $desc;
    }

    /**
     * @return mixed
     */
    public function getStudentLevel()
    {
        return $this->student_level;
    }

    /**
     * @param mixed $student_level
     */
    public function setStudentLevel($student_level): void
    {
        $this->student_level = $student_level;
    }

    /**
     * @return mixed
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * @param mixed $capacity
     */
    public function setCapacity($capacity): void
    {
        $this->capacity = $capacity;
    }

    /**
     * @return mixed
     */
    public function getNbAnimJeudi()
    {
        return $this->nbAnim_jeudi;
    }

    /**
     * @param mixed $nbAnim_jeudi
     */
    public function setNbAnimJeudi($nbAnim_jeudi): void
    {
        $this->nbAnim_jeudi = $nbAnim_jeudi;
    }

    /**
     * @return mixed
     */
    public function getNbAnimVendredi()
    {
        return $this->nbAnim_vendredi;
    }

    /**
     * @param mixed $nbAnim_vendredi
     */
    public function setNbAnimVendredi($nbAnim_vendredi): void
    {
        $this->nbAnim_vendredi = $nbAnim_vendredi;
    }

    /**
     * @return mixed
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * @param mixed $duree
     */
    public function setDuree($duree): void
    {
        $this->duree = $duree;
    }

    /**
     * @return mixed
     */
    public function getInter()
    {
        return $this->inter;
    }

    /**
     * @param mixed $inter
     */
    public function setInter($inter): void
    {
        $this->inter = $inter;
    }

    /**
     * @return mixed
     */
    public function getPauseStart()
    {
        return $this->pause_start;
    }

    /**
     * @param mixed $pause_start
     */
    public function setPauseStart($pause_start): void
    {
        $this->pause_start = $pause_start;
    }

    /**
     * @return mixed
     */
    public function getPauseEnd()
    {
        return $this->pause_end;
    }

    /**
     * @param mixed $pause_end
     */
    public function setPauseEnd($pause_end): void
    {
        $this->pause_end = $pause_end;
    }

    public function getActivities()
    {
        return $this->activities;
    }

    public function setActivities($activities): void
    {
        $this->activities = $activities;
    }

}