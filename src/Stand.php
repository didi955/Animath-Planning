<?php

class Stand
{
    private $id;

    private $id_user;

    private $title;

    private $desc;

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

    public function getIdUser()
    {
        return $this->id_user;
    }

    public function setIdUser($id_user): void
    {
        $this->id_user = $id_user;
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

    public function getActivities()
    {
        return $this->activities;
    }

    public function setActivities($activities): void
    {
        $this->activities = $activities;
    }
}