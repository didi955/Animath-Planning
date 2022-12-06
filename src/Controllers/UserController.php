<?php

class UserController extends Controller
{
    /**
     * @inheritDoc
     */
    public function action_default()
    {
        $this->action_myAccount();
    }

    public function action_myAccount()
    {
        $this->render('myAccount');
    }

    public function action_sign_in(){
        // CHECK IF MAIL EXISTS
        // GET PASS HASH
        // IF PASS HASH === GIVEN PASS HASH
        // VALID
        if(isset($_POST['email']) && preg_match("/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/", $_POST['email']) && isset($_POST['pass'])){


        }
    }

    public function action_sign_up(){
        if(isset($_GET['email'])){
            $user = new User();
            $user->setUUID(uuid_create(UUID_TYPE_RANDOM));
            $user->setEmail($_POST['email']);
            $user->setActive(false);
            $user->setPassHash($_POST['pass']);
            $user->setLastName($_POST['last_name']);
            $user->setFirstName($_POST['first_name']);
            $user->setRole(Role::PROFESSOR);
            $user->setCreatedAt(time());
            $user->save();
            $this->render("home");
        }
        else {
            $this->action_error("Erreur lors de la création du compte", 444);
        }
    }
}