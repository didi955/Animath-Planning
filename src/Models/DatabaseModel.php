<?php

class DatabaseModel
{

    /**
     * Attribut contenant l'instance PDO
     */
    private $bd;

    /**
     * Attribut statique qui contiendra l'unique instance de Model
     */
    private static $instance = null;

    /**
     * Constructeur : effectue la connexion à la base de données.
     */
    private function __construct()
    {
        $credentials = parse_ini_file("../db_credentials.ini");
        $host = $credentials['host'];
        $dbname = $credentials['dbname'];
        $user = $credentials['user'];
        $pass = $credentials['pass'];
        $dsn = "pgsql:host=$host;port=5432;dbname=$dbname;";
        $this->bd = new PDO($dsn, $user, $pass);
        $this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->bd->query("SET names 'utf8'");
    }

    /**
     * Méthode permettant de récupérer un modèle car le constructeur est privé (Implémentation du Design Pattern Singleton)
     */
    public static function getModel()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @return PDO
     */
    public function getBD(): PDO
    {
        return $this->bd;
    }





}