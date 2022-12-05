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

    public function action_connection(){
        if(isset($_POST['email']) && preg_match("/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/", $_POST['email']) && isset($_POST['pass'])){


        }
    }
}