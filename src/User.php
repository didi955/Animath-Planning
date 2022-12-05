<?php

class User
{

    /**
     * Attribut caractérisant le UUID de l'utilisateur
     */
    private $uuid;

    /**
     * Attribut caractérisant le nom de l'utilisateur
     */
    private $lastName;

    /**
     * Attribut caractérisant le prénom de l'utilisateur
     */
    private $firstName;

    /**
     * Attribut caractérisant le numéro de téléphone de l'utilisateur
     */
    private $phone;

    /**
     * Attribut caractérisant l'adresse mail de l'utilisateur
     */
    private $mail;

    private $role;

    private $active;

    private $created_at;

    public function __construct($uuid, $lastName, $firstName, $mail, $phone, $role, $active, $created_at)
    {
        $this->uuid = $uuid;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->mail = $mail;
        $this->phone = $phone;
        $this->role = $role;
        $this->active = $active;
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getUUID()
    {
        return $this->uuid;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @return mixed
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }





}