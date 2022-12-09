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
     * @return UserModel
     */
    public static function getModel()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Méthode permettant de savoir si il existe un utilisateur à partir d'un UUID
     * @param string $uuid UUID demandé
     * @return bool
     */
    public function isInDatabase($uuid){
        $req = DatabaseModel::getModel()->getBD()->prepare('SELECT uuid FROM "User" WHERE uuid= :uuid');
        $req->bindValue(":uuid", $uuid);
        $req->execute();
        $rs = $req->fetch();
        if($rs){
            return true;
        }
        return false;
    }

    /**
     * Méthode permettant de récupérer un utilisateur à partir de son UUID
     * @param string $uuid UUID demandé
     * @return User|null
     */
    public function getUser(string $uuid){
        if(!$this->isInDatabase($uuid)){
            return null;
        }
        $req = DatabaseModel::getModel()->getBD()->prepare('SELECT uuid, pass_hash, role, active, created_at, last_name, first_name, email, phone FROM "User" inner join "PersonalData" on uuid = "PersonalData".id_user WHERE uuid= :uuid');
        $req->bindValue(":uuid", $uuid);
        $req->execute();
        $rs = $req->fetch(PDO::FETCH_ASSOC);
        if(!$rs){
            return null;
        }
        return $this->buildUser($rs);
    }

    /**
     * Méthode permettant de récupérer un utilisateur à partir de son mail
     * @param string $email Mail demandé
     * @return User|null
     */
    public function getUserByEmail(string $email){
        $req = DatabaseModel::getModel()->getBD()->prepare('SELECT uuid, role, pass_hash, active, created_at, email, 
       last_name, first_name, phone FROM "User" inner join "PersonalData" on uuid = "PersonalData".id_user WHERE email = :email');
        $req->bindValue(":email", $email);
        $req->execute();
        $rs = $req->fetch(PDO::FETCH_ASSOC);
        if(!$rs){
            return null;
        }
        return $this->buildUser($rs);
    }

    /**
     * Méthode permettant de désactiver le compte d'un utilisateur
     * @param User $user Utilisateur à désactiver
     */
    public function desactivateUser(User $user){
        if($this->isInDatabase($user)){
            $req = DatabaseModel::getModel()->getBD()->prepare('UPDATE SET active=:value FROM "User" WHERE uuid = :value2');
            $req->bindValue(":value", false);
            $req->execute();
        }
    }

    /**
     * Méthode permettant d'activer le compte d'un utilisateur
     * @param User $user Utilisateur à activer
     */
    public function activateUser(User $user){
        if($this->isInDatabase($user)){
            $req = DatabaseModel::getModel()->getBD()->prepare('UPDATE SET active=:value FROM "User" WHERE uuid = :value2');
            $req->bindValue(":value", true);
            $req->bindValue(":value2", $user->getUUID());
            $req->execute();
        }
    }

    /**
     * Méthode permettant d'enregistrer un utilisateur dans la base de données
     * @param User $user Utilisateur à enregistrer
     */
    public function createUser(User $user){
        if(!$this->isInDatabase($user->getUUID())){
            try {
                DatabaseModel::getModel()->getBD()->beginTransaction();
                $req = DatabaseModel::getModel()->getBD()->prepare('INSERT INTO "User" (uuid, role, active, pass_hash) VALUES (:uuid, :role, :active, :pass_hash)');
                $req->bindValue(":uuid", $user->getUUID());
                $req->bindValue(":role", $user->getRole()->value, PDO::PARAM_INT);
                $req->bindValue(":active", $user->isActive(), PDO::PARAM_BOOL);
                $req->bindValue(":pass_hash", $user->getPassHash());
                $req->execute();

                $req = DatabaseModel::getModel()->getBD()->prepare('INSERT INTO "PersonalData" (id_user, last_name, first_name, email, phone) VALUES (:uuid, :last_name, :first_name, :mail, :phone)');
                $req->bindValue(":uuid", $user->getUUID());
                $req->bindValue(":last_name", $user->getLastName(), );
                $req->bindValue(":first_name", $user->getFirstName());
                $req->bindValue(":mail", $user->getEmail());
                $req->bindValue(":phone", $user->getPhone());

                $req->execute();
                DatabaseModel::getModel()->getBD()->commit();

            } catch (PDOException $e) {
                // rollback the changes
                DatabaseModel::getModel()->getBD()->rollback();
                throw $e;
            }
        }
    }

    /**
     * Méthode permettant de mettre à jour un utilisateur dans la base de données
     * @param User $user Utilisateur à mettre à jour
     */
    public function updateUser(User $user){
        if($this->isInDatabase($user->getUUID())){
            try {
                DatabaseModel::getModel()->getBD()->beginTransaction();
                $req = DatabaseModel::getModel()->getBD()->prepare('UPDATE "User" SET role=:role, active=:active, pass_hash=:pass_hash WHERE uuid = :uuid');
                $req->bindValue(":uuid", $user->getUUID());
                $req->bindValue(":role", $user->getRole()->value, PDO::PARAM_INT);
                $req->bindValue(":active", $user->isActive(), PDO::PARAM_BOOL);
                $req->bindValue(":pass_hash", $user->getPassHash());
                $req->execute();

                $req = DatabaseModel::getModel()->getBD()->prepare('UPDATE "PersonalData" SET last_name=:last_name, first_name=:first_name, email=:mail, phone=:phone WHERE id_user = :uuid');
                $req->bindValue(":uuid", $user->getUUID());
                $req->bindValue(":last_name", $user->getLastName(), );
                $req->bindValue(":first_name", $user->getFirstName());
                $req->bindValue(":mail", $user->getEmail());
                $req->bindValue(":phone", $user->getPhone());

                $req->execute();
                DatabaseModel::getModel()->getBD()->commit();

            } catch (PDOException $e) {
                // rollback the changes
                DatabaseModel::getModel()->getBD()->rollback();
                throw $e;
            }
        }
    }

    /**
     * Méthode permettant de mettre à jour le mot de passe d'un utilisateur dans la base de données
     * @param User $user Utilisateur à mettre à jour
     * @param string $newPass Nouveau mot de passe
     */
    public function changePass(User $user, $newPass){
        if($this->isInDatabase($user)){
            $req = DatabaseModel::getModel()->getBD()->prepare('UPDATE SET pass_hash=:value FROM "User" WHERE uuid = :value2');
            $hash = hash_pass($newPass);
            $req->bindValue(":value", $hash);
            $req->bindValue(":value2", $user->getUUID());
            $req->execute();
        }
    }

    /**
     * Méthode permettant de construire un objet User à partir d'un tableau de données
     * @param array $rs Tableau de données
     * @return User Utilisateur construit
     */
    private function buildUser($rs){
        $user = new User();
        $user->setPassHash($rs['pass_hash']);
        $user->setUUID($rs['uuid']);
        $user->setRole(Role::valueOf($rs['role']));
        $user->setActive($rs['active']);
        $user->setCreatedAt($rs['created_at']);
        $user->setLastName($rs['last_name']);
        $user->setFirstName($rs['first_name']);
        $user->setEmail($rs['email']);
        $user->setPhone($rs['phone']);
        return $user;
    }

}