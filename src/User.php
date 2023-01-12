<?php

class User
{

    /**
     * Attribut caractérisant le UUID de l'utilisateur
     */
    private $id;

    /**
     * Attribut caractérisant l'identifiant de connexion
     */
    private $connexion_id;

    /**
     * Attribut caractérisant le role de l'utilisateur
     */
    private $role;

    private $personalData;

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
     * @return int UUID de l'utilisateur
     */
    public function getID() : int
    {
        return $this->id;
    }

    public function getConnexionID(): string
    {
        return $this->connexion_id;
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

    public function getPersonalData(){
        if($this->role !== Role::PROFESSOR){
            return null;
        }
        return $this->personalData;
    }

    /**
     * Méthode permettant de définir l'UUID de l'utilisateur
     * @param string $id Nouvel UUID de l'utilisateur
     */
    public function setID(string $id): void
    {
        $this->id = $id;
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
     * Méthode permettant de définir le mot de passe hashé de l'utilisateur
     * @param string $pass_hash Nouveau mot de passe hashé de l'utilisateur
     */
    public function setConnexionID($connexion_id): void
    {
        $this->connexion_id = $connexion_id;
    }

    public function setPersonalData($data): void
    {
        if($this->role === Role::PROFESSOR){
            $this->personalData = $data;
        }
    }

    /**
     * Méthode permettant d'enregistrer l'utilisateur dans la base de données
     */
    public function save(): void
    {
        if(UserModel::getModel()->isInDatabase($this->id))
        {
            UserModel::getModel()->updateUser($this);
        }
        else
        {
            UserModel::getModel()->createUser($this);
        }
    }







}