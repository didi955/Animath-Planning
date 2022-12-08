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

    public function action_my_account()
    {
        $this->render('myAccount');
    }

    public function action_sign_in(){
        if(isset($_POST['email']) && preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/", $_POST['email']) && isset($_POST['pass'])){
            $user = UserModel::getModel()->getUserByEmail($_POST['email']);
            if($user != null) {
                if(password_verify($_POST['pass'], $user->getPassHash())){
                    $_SESSION['uuid'] = $user->getUUID();
                    setcookie('uuid', $user->getUUID(), time() + 3600 * 24 * 30, '/', '', true, true);
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
    }

    public function action_sign_out() : void{
        if(isset($_SESSION['uuid'])){
            if(isset($_COOKIE['uuid'])){
                unset($_COOKIE['uuid']);
                setcookie('uuid', null, -1, '/');
            }
            session_destroy();
            $this->render("home");
        }
    }

    public function action_sign_up(){
        if(isset($_POST['email']) && preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/", $_POST['email'])
            && isset($_POST['pass']) && isset($_POST['pass_confirm']) && $_POST['pass'] === $_POST['pass_confirm'] &&
            isset($_POST['last_name']) && isset($_POST['first_name']) && isset($_POST['cgu_accept']) && $_POST['cgu_accept'] === 'on'){
            $user = new User();
            $user->setUUID(Uuid::uuid4()->toString());
            $user->setEmail($_POST['email']);
            $user->setActive(false);
            $user->setPassHash(encrypt_pass($_POST['pass']));
            $user->setLastName($_POST['last_name']);
            $user->setFirstName($_POST['first_name']);
            $user->setRole(Role::PROFESSOR);
            $user->save();
            $this->render("home");
            $_SESSION['uuid'] = $user->getUUID();
            setcookie('uuid', $user->getUUID(), time() + 3600 * 24 * 30, '/', '', true, true);

        }
        else {
            $this->action_error("Erreur lors de la création du compte", 444);
        }
    }
}