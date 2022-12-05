<?php

class UserModel
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
     * Méthode permettant de récupérer un modèle car le constructeur est privé (Implémentation du Design Pattern Singleton)
     */
    public static function getModel()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function isInDatabase($uuid){
        $req = DatabaseModel::getModel()->getBD()->prepare('SELECT uuid FROM "User" WHERE uuid= :uuid');
        $req->bindValue(":uuid", $uuid);
        $req->execute();
        if($req->rowCount() > 0){
            return true;
        }
        return false;
    }

    public function getUser(string $uuid){
        $req = DatabaseModel::getModel()->getBD()->prepare('SELECT uuid, role, active, created_at, last_name, first_name, mail, num FROM "User" inner join "PersonalData" on uuid = "PersonalData".id_user');
        $req->execute();
        $rs = $req->fetch(PDO::FETCH_ASSOC);
        return new User($uuid, $rs['last_name'], $rs['first_name'], $rs['mail'], $rs['phone'], $rs['role'], $rs['active'], $rs['created_at']);
    }

    public function desactivateUser(User $user){
        if($this->isInDatabase($user)){
            $req = DatabaseModel::getModel()->getBD()->prepare('UPDATE SET active=:value FROM "User" WHERE uuid = :value2');
            $req->bindValue(":value", false);
            $req->execute();
        }
    }

    public function activateUser(User $user){
        if($this->isInDatabase($user)){
            $req = DatabaseModel::getModel()->getBD()->prepare('UPDATE SET active=:value FROM "User" WHERE uuid = :value2');
            $req->bindValue(":value", true);
            $req->bindValue(":value2", $user->getUUID());
            $req->execute();
        }
    }

    public function createUser(User $user){
        if(!$this->isInDatabase($user)){
            try {
                DatabaseModel::getModel()->getBD()->beginTransaction();
                $req = DatabaseModel::getModel()->getBD()->prepare('INSERT INTO "User" (uuid, role, active) VALUES (:uuid, :role, :active, :pass_hash)');
                $req->bindValue(":uuid", $user->getUUID());
                $req->bindValue(":role", $user->getRole());
                $req->bindValue(":active", $user->isActive());
                $req->bindValue(":pass_hash", $user->getPassHash());
                $req->execute();

                $req = DatabaseModel::getModel()->getBD()->prepare('INSERT INTO "PersonalData" (id_user, last_name, first_name, mail, phone) VALUES (:uuid, :last_name, :first_name, :mail, :phone)');
                $req->bindValue(":uuid", $user->getUUID());
                $req->bindValue(":last_name", $user->getLastName());
                $req->bindValue(":first_name", $user->getFirstName());
                $req->bindValue(":mail", $user->getEmail());
                $req->bindValue(":phone", $user->getPhone());

                DatabaseModel::getModel()->getBD()->commit();

            } catch (PDOException $e) {
                // rollback the changes
                DatabaseModel::getModel()->getBD()->rollback();
                throw $e;
            }
        }


    }

    public function changePass(User $user, $newPass){
        if($this->isInDatabase($user)){
            $req = DatabaseModel::getModel()->getBD()->prepare('UPDATE SET pass_hash=:value FROM "User" WHERE uuid = :value2');
            $hash = encrypt_pass($newPass);
            $req->bindValue(":value", $hash);
            $req->bindValue(":value2", $user->getUUID());
            $req->execute();
        }
    }

    public function verify_password($uuid, $pass){
        if($this->isInDatabase($uuid)){
            $req = DatabaseModel::getModel()->getBD()->prepare('SELECT pass_hash FROM "User" WHERE uuid= :value' );
            $req->bindValue(":value", $uuid);
            $req->execute();
            $rs = $req->fetch(PDO::FETCH_ASSOC);
            if(password_verify($pass, $rs['pass_hash'])){
                return true;
            }
            return false;
        }
    }










}