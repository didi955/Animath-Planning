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

    /**
     * Attribut caractérisant le role de l'utilisateur
     */
    private $role;

    /**
     * Attribut caractérisant le statut de l'utilisateur
     */
    private $active;

    /**
     * Attribut caractérisant la date de création de l'utilisateur
     */
    private $created_at;

    /**
     * Attribut caractérisant le mot de passe hashé de l'utilisateur
     */
    private $pass_hash;

    public function __construct()
    {
    }

    /**
     * Méthode permettant de récupérer l'UUID de l'utilisateur
     * @return string UUID de l'utilisateur
     */
    public function getUUID() : string
    {
        return $this->uuid;
    }

    /**
     * Méthode permettant de récupérer le nom de l'utilisateur
     * @return string Nom de l'utilisateur
     */
    public function getLastName() : string
    {
        return $this->lastName;
    }

    /**
     * Méthode permettant de récupérer le prénom de l'utilisateur
     * @return string Prénom de l'utilisateur
     */
    public function getFirstName() : string
    {
        return $this->firstName;
    }

    /**
     * Méthode permettant de récupérer le numéro de téléphone de l'utilisateur
     * @return string Numéro de téléphone de l'utilisateur
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Méthode permettant de récupérer l'adresse mail de l'utilisateur
     * @return string Adresse mail de l'utilisateur
     */
    public function getEmail() : string
    {
        return $this->mail;
    }

    /**
     * Méthode permettant de récupérer le role de l'utilisateur
     * @return Role Role de l'utilisateur
     */
    public function getRole() : Role
    {
        return $this->role;
    }

    /**
     * Méthode permettant de récupérer le statut de l'utilisateur
     * @return bool Statut de l'utilisateur
     */
    public function isActive() : bool
    {
        return $this->active;
    }

    /**
     * Méthode permettant de récupérer la date de création de l'utilisateur
     * @return  int Timestamp correspodant à la date de création de l'utilisateur
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Méthode permettant de récupérer le mot de passe hashé de l'utilisateur
     * @return string Mot de passe hashé de l'utilisateur
     */
    public function getPassHash() : string
    {
        return $this->pass_hash;
    }

    /**
     * Méthode permettant de définir l'UUID de l'utilisateur
     * @param string $uuid Nouvel UUID de l'utilisateur
     */
    public function setUUID($uuid): void
    {
        $this->uuid = $uuid;
    }

    /**
     * Méthode permettant de définir le nom de l'utilisateur
     * @param string $lastName Nouveau nom de l'utilisateur
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * Méthode permettant de définir le prénom de l'utilisateur
     * @param string $firstName Nouveau prénom de l'utilisateur
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * Méthode permettant de définir le numéro de téléphone de l'utilisateur
     * @param string $phone Nouveau numéro de téléphone de l'utilisateur
     */
    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }

    /**
     * Méthode permettant de définir l'adresse mail de l'utilisateur
     * @param string $mail Nouvelle adresse mail de l'utilisateur
     */
    public function setEmail(string $mail): void
    {
        $this->mail = $mail;
    }

    /**
     * Méthode permettant de définir le role de l'utilisateur
     * @param Role $role Nouveau role de l'utilisateur
     */
    public function setRole(Role $role): void
    {
        $this->role = $role;
    }

    /**
     * Méthode permettant de définir le statut de l'utilisateur
     * @param bool $active Nouveau statut de l'utilisateur
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * Méthode permettant de définir la date de création de l'utilisateur
     * @param int $created_at Nouvelle date de création de l'utilisateur
     */
    public function setCreatedAt($created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * Méthode permettant de définir le mot de passe hashé de l'utilisateur
     * @param string $pass_hash Nouveau mot de passe hashé de l'utilisateur
     */
    public function setPassHash($pass_hash): void
    {
        $this->pass_hash = $pass_hash;
    }

    /**
     * Méthode permettant d'enregistrer l'utilisateur dans la base de données
     */
    public function save(): void
    {
        if(UserModel::getModel()->isInDatabase($this->uuid))
        {
            UserModel::getModel()->updateUser($this);
        }
        else
        {
            UserModel::getModel()->createUser($this);
        }
    }









}