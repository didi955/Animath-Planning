<?php

class ProfessorModel
{

    /**
     * Attribut statique qui contiendra l'unique instance de Model
     */
    private static $instance = null;

    /**
     * Constructeur : effectue la connexion à la base de données.
     */
    private function __construct(){}

    /**
     *
     * Méthode permettant de récupérer un modèle car le constructeur est privé (Implémentation du Design Pattern Singleton)
     * @return ProfessorModel
     */
    public static function getModel()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }


    public function getPersonalData($id){
        $req = DatabaseModel::getModel()->getBD()->prepare('SELECT * from "PersonalData" WHERE id_user=:id');
        $req->bindValue(":id", $id);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }

}