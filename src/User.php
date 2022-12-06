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

    private $pass_hash;

    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getUUID() : string
    {
        return $this->uuid;
    }

    /**
     * @return mixed
     */
    public function getLastName() : string
    {
        return $this->lastName;
    }

    /**
     * @return mixed
     */
    public function getFirstName() : string
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
    public function getEmail() : string
    {
        return $this->mail;
    }

    /**
     * @return mixed
     */
    public function getRole() : Role
    {
        return $this->role;
    }

    /**
     * @return mixed
     */
    public function isActive() : bool
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

    /**
     * @return mixed
     */
    public function getPassHash() : string
    {
        return $this->pass_hash;
    }

    /**
     * @param mixed $uuid
     */
    public function setUUID($uuid): void
    {
        $this->uuid = $uuid;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @param mixed $mail
     */
    public function setEmail(string $mail): void
    {
        $this->mail = $mail;
    }

    /**
     * @param mixed $role
     */
    public function setRole(Role $role): void
    {
        $this->role = $role;
    }

    /**
     * @param mixed $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @param mixed $pass_hash
     */
    public function setPassHash($pass_hash): void
    {
        $this->pass_hash = $pass_hash;
    }

    public function save(): void
    {
        UserModel::getModel()->createUser($this);
    }









}