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

    public function isSupervisor($email){
        $sql = 'SELECT id_user FROM "User" WHERE role = :role AND connexion_id = :email';
        $req = DatabaseModel::getModel()->getBD()->prepare($sql);
        $req->bindValue(':role', Role::SUPERVISOR->value);
        $req->bindValue(':email', $email);
        $req->execute();
        $result = $req->fetch();
        if($result){
            return true;
        }
        return false;
    }

    public function deleteSupervisor($email){
        $sql = 'DELETE FROM "User" WHERE role = :role AND connexion_id = :email';
        $req = DatabaseModel::getModel()->getBD()->prepare($sql);
        $req->bindValue(':role', Role::SUPERVISOR->value);
        $req->bindValue(':email', $email);
        $req->execute();
    }

    /**
     * Méthode permettant de savoir si il existe un utilisateur à partir d'un UUID
     * @param string $uuid UUID demandé
     * @return bool
     */
    public function isInDatabase($id){
        $req = DatabaseModel::getModel()->getBD()->prepare('SELECT id_user FROM "User" WHERE id_user= :id');
        $req->bindValue(":id", $id);
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
    public function getUser(string $id){
        if(!$this->isInDatabase($id)){
            return null;
        }
        $req = DatabaseModel::getModel()->getBD()->prepare('SELECT id_user, pass_hash, role, active, created_at, connexion_id FROM "User" WHERE id_user=:id');
        $req->bindValue(":id", $id);
        $req->execute();
        $rs = $req->fetch(PDO::FETCH_ASSOC);
        if(!$rs){
            return null;
        }
        $role = Role::valueOf($rs['role']);
        $pdatas = null;
        if($role == Role::PROFESSOR){
            $pdatas = ProfessorModel::getModel()->getPersonalData($id);
            if($pdatas!= null){
                return $this->buildUser($rs, $pdatas);
            }
        }
        return $this->buildUser($rs, $pdatas);
    }
    /**
     * Méthode permettant de récupérer un utilisateur à partir de son mail
     * @param string $email Mail demandé
     * @return User|null
     */
    public function getUserByConnexionID(string $connexion_id){
        $req = DatabaseModel::getModel()->getBD()->prepare('SELECT id_user, pass_hash, role, active, created_at, connexion_id FROM "User" WHERE connexion_id=:connexion_id');
        $req->bindValue(":connexion_id", $connexion_id);
        $req->execute();
        $rs = $req->fetch(PDO::FETCH_ASSOC);
        if(!$rs){
            return null;
        }
        $role = Role::valueOf($rs['role']);
        $pdatas = null;
        if($role == Role::PROFESSOR){
            $req = DatabaseModel::getModel()->getBD()->prepare('SELECT last_name, first_name, email, phone, school FROM "PersonalData" WHERE id_user=:id');
            $req->bindValue(":id", $rs['id_user']);
            $req->execute();
            $pdatas = $req->fetch(PDO::FETCH_ASSOC);
            if($pdatas!= null){
                return $this->buildUser($rs, $pdatas);
            }
        }
        return $this->buildUser($rs, $pdatas);
    }

    /**
     * Méthode permettant de désactiver le compte d'un utilisateur
     * @param User $user Utilisateur à désactiver
     */
    public function desactivateUser(User $user){
        if($this->isInDatabase($user)){
            $req = DatabaseModel::getModel()->getBD()->prepare('UPDATE SET active=:value FROM "User" WHERE id_user = :value2');
            $req->bindValue(":value", false);
            $req->bindValue(":value2", $user->getID());
            $req->execute();
        }
    }

    public function getMaxID(){
        $req = DatabaseModel::getModel()->getBD()->prepare('SELECT id_user FROM "User" ORDER BY id_user DESC LIMIT 1');
        $req->execute();
        $rs = $req->fetch(PDO::FETCH_ASSOC);
        if(!$rs){
            return 0;
        }
        return $rs['id_user'];
    }

    /**
     * Méthode permettant d'activer le compte d'un utilisateur
     * @param User $user Utilisateur à activer
     */
    public function activateUser(User $user){
        if($this->isInDatabase($user)){
            $req = DatabaseModel::getModel()->getBD()->prepare('UPDATE SET active=:value FROM "User" WHERE uuid = :value2');
            $req->bindValue(":value", true);
            $req->bindValue(":value2", $user->getID());
            $req->execute();
        }
    }

    /**
     * Méthode permettant d'enregistrer un utilisateur dans la base de données
     * @param User $user Utilisateur à enregistrer
     */
    public function createUser(User $user){
        try {
            DatabaseModel::getModel()->getBD()->beginTransaction();
            $req = DatabaseModel::getModel()->getBD()->prepare('INSERT INTO "User" (id_user, role, active, pass_hash, connexion_id) VALUES (:id_user, :role, :active, :pass_hash, :connexion_id)');
            $req->bindValue(":id_user", $user->getID());
            $req->bindValue(":role", $user->getRole()->value, PDO::PARAM_INT);
            $req->bindValue(":active", $user->isActive(), PDO::PARAM_BOOL);
            $req->bindValue(":pass_hash", $user->getPassHash());
            $req->bindValue(":connexion_id", $user->getConnexionID());
            $req->execute();

            if($user->getPersonalData() !== null && $user->getRole() === Role::PROFESSOR){
                $req = DatabaseModel::getModel()->getBD()->prepare('INSERT INTO "PersonalData" (id_user, last_name, first_name, email, phone, school) VALUES (:id, :last_name, :first_name, :email, :phone, :school)');
                $req->bindValue(":id", $user->getID());
                foreach ($user->getPersonalData() as $key=>$value){
                    $req->bindValue($key, $value);
                }
                $req->execute();
            }

            DatabaseModel::getModel()->getBD()->commit();

        } catch (PDOException $e) {
            // rollback the changes
            DatabaseModel::getModel()->getBD()->rollback();
        }
    }

    /**
     * Méthode permettant de mettre à jour un utilisateur dans la base de données
     * @param User $user Utilisateur à mettre à jour
     */
    public function updateUser(User $user){
        if($this->isInDatabase($user->getID())){
            try {
                DatabaseModel::getModel()->getBD()->beginTransaction();
                $req = DatabaseModel::getModel()->getBD()->prepare('UPDATE "User" SET role=:role, active=:active, pass_hash=:pass_hash, connexion_id=:connexion_id WHERE id_user = :id');
                $req->bindValue(":id", $user->getID());
                $req->bindValue(":role", $user->getRole()->value, PDO::PARAM_INT);
                $req->bindValue(":active", $user->isActive(), PDO::PARAM_BOOL);
                $req->bindValue(":pass_hash", $user->getPassHash());
                $req->bindValue(":connexion_id", $user->getConnexionID());
                $req->execute();

                //PERSONAL DATA
                if($user->getPersonalData() != null && $user->getRole() === Role::PROFESSOR){
                    $req = DatabaseModel::getModel()->getBD()->prepare('UPDATE "PersonalData" SET last_name=:last_name, first_name=:first_name, email=:email, phone=:phone, school=:school WHERE id_user = :id');
                    $req->bindValue(":id", $user->getID());
                    foreach ($user->getPersonalData() as $key=>$value){
                        $req->bindValue($key, $value);
                    }

                    $req->execute();
                }

                DatabaseModel::getModel()->getBD()->commit();

            } catch (PDOException $e) {
                // rollback the changes
                DatabaseModel::getModel()->getBD()->rollback();
                throw $e;
            }
        }
    }

    public function getSuperviseurs(){
        $req = DatabaseModel::getModel()->getBD()->prepare('SELECT connexion_id from "User" WHERE role=:role');
        $req->bindValue(':role', Role::SUPERVISOR->value);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Méthode permettant de construire un objet User à partir d'un tableau de données
     * @param array $rs Tableau de données
     * @return User Utilisateur construit
     */
    public function buildUser($rs, $pdatas){
        $user = new User();
        if(isset($rs['id_user'])){
            $user->setID($rs['id_user']);
        }
        if(isset($rs['role'])){
            $user->setRole(Role::valueOf($rs['role']));
        }
        if(isset($rs['active'])){
            $user->setActive($rs['active']);
        }
        if(isset($rs['pass_hash'])){
            $user->setPassHash($rs['pass_hash']);
        }
        if(isset($rs['created_at'])){
            $user->setCreatedAt($rs['created_at']);
        }
        if(isset($rs['connexion_id'])){
            $user->setConnexionID($rs['connexion_id']);
        }
        if(isset($pdatas) && $pdatas != null){
            $user->setPersonalData($pdatas);
        }
        return $user;
    }



}