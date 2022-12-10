<?php

use Ramsey\Uuid\Nonstandard\Uuid;
require 'User.php';
require 'Utils/Role.php';

class UserController extends Controller
{

    /**
     * @inheritDoc
     */
    public function action_default()
    {
        $this->action_my_account();
    }

    /**
     * Action pour afficher la page de mon compte
     */
    public function action_my_account()
    {
        if(!isset($_SESSION['user'])){
            if(!isset($_COOKIE['user'])){
                $this->action_error("Vous n'êtes pas connecté !", 444);
                return;
            }
            else {
                $user = unserialize($_COOKIE['user']);
                if($user == null){
                    $this->action_error("Vous n'êtes pas connecté !", 444);
                    return;
                }
                else {
                    $user = UserModel::getModel()->getUser($user->getUUID());
                    if($user == null){
                        $this->action_error("Impossible de d'accéder à votre compte", 444);
                        return;
                    }
                    else {
                        $_SESSION['user'] = $user;
                    }
                }
            }
        }
        else {
            $user = unserialize($_SESSION['user']);
            if($user == null){
                $this->action_error("Vous n'êtes pas connecté !", 444);
                return;
            }
        }
        $this->render('myAccount', ['user' => $user]);
    }

    /**
     * Action pour se connecter
     */
    public function action_sign_in(){
        if(isset($_POST['email'])){
            $mail = strtolower($_POST['email']);
            if(is_valid_email($mail) && isset($_POST['pass'])){
                $user = UserModel::getModel()->getUserByEmail($mail);
                if($user != null) {
                    if(password_verify($_POST['pass'], $user->getPassHash())){
                        $_SESSION['user'] = serialize($user);
                        if(isset($_POST['remember']) && $_POST['remember'] == "on"){
                            setcookie('user', serialize($user), time() + 3600 * 24 * 30, '/', '', true, true);
                        }
                        $this->render('home');
                    }
                    else {
                        $this->action_error('Mot de passe incorrect', 444);
                    }
                }
                else {
                    $this->action_error('Adresse mail inconnue', 444);
                }
            }
            else {
                $this->action_error('Adresse mail ou mot de passe invalide', 444);
            }
        }
        $this->action_error('Adresse mail non spécifiée', 444);
    }

    /**
     * Action pour se déconnecter
     */
    public function action_sign_out() : void{
        $_SESSION= array();
        if(isset($_COOKIE['user'])){
            unset($_COOKIE['user']);
            setcookie('user', '', -1, '/');
        }
        session_destroy();
        $this->render("home");
    }

    /**
     * Action pour s'inscrire
     */
    public function action_sign_up(){
        if(isset($_POST['email'])){
            $mail = strtolower($_POST['email']);
            if(is_valid_email($mail)
                && isset($_POST['pass']) && isset($_POST['pass_confirm']) && $_POST['pass'] === $_POST['pass_confirm'] &&
                isset($_POST['last_name']) && isset($_POST['first_name']) && is_valid_name($_POST['last_name']) && is_valid_name($_POST['first_name']) &&isset($_POST['cgu_accept']) && $_POST['cgu_accept'] === 'on'){

                if(UserModel::getModel()->getUserByEmail($mail) == null) {
                    $user = new User();
                    $user->setUUID(Uuid::uuid4()->toString());
                    $user->setEmail($mail);
                    $user->setActive(false);
                    $user->setPassHash(hash_pass($_POST['pass']));
                    $user->setLastName($_POST['last_name']);
                    $user->setFirstName($_POST['first_name']);
                    $user->setRole(Role::PROFESSOR);
                    $user->save();
                    $this->render("home");
                    $_SESSION['user'] = serialize($user);
                    setcookie('user', serialize($user), time() + 3600 * 24 * 30, '/', '', true, true);
                }
                else {
                    $this->action_error('Adresse mail déjà utilisée', 444);
                }
            }
            else {
                $this->action_error('Formulaire invalide', 444);
            }
        }
        else {
            $this->action_error("Adresse mail non spécifiée", 444);
        }
    }
}