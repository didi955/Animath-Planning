<?php

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
        $this->render('home');
    }
}