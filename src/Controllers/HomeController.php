<?php

require 'User.php';
require 'Utils/Role.php';

class HomeController extends Controller
{
    /**
     * @inheritDoc
     */
    public function action_default()
    {
        $this->action_home();
    }

    public function action_home()
    {
        if(!isset($_SESSION['user'])){
            if(isset($_COOKIE['user'])){
                $user = unserialize($_COOKIE['user']);
                $user = UserModel::getModel()->getUser($user->getUUID());
                if($user != null){
                    $_SESSION['user'] = serialize($user);
                }
            }
        }
        $this->render('home');
    }
}