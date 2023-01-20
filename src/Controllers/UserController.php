<?php

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
                $this->action_error("Vous n'êtes pas connecté !");
                return;
            }
            else {
                $user = unserialize($_COOKIE['user']);
                if($user == null){
                    $this->action_error("Vous n'êtes pas connecté !");
                    return;
                }
                else {
                    $user = UserModel::getModel()->getUser($user->getID());
                    if($user == null){
                        $this->action_error("Impossible de d'accéder à votre compte");
                        return;
                    }
                    else {
                        $_SESSION['user'] = serialize($user);
                    }
                }
            }
        }
        else {
            $user = unserialize($_SESSION['user']);
            if($user == null){
                $this->action_error("Vous n'êtes pas connecté !");
                return;
            }
            if($user->getRole() === Role::SUPERVISOR){
                $this->action_gestion();
                return;
            }
        }
        $this->render('myAccount', ['user' => $user, 'appointements' => ReservationModel::getModel()->getMyReservations($user->getID())]);
    }

    public function action_gestion(){
        if(isset($_SESSION['user']) && unserialize($_SESSION['user'])->getRole() === Role::SUPERVISOR) {
            $this->render('gestion', ['stands' => StandModel::getModel()->getAllStand(), 'user' => unserialize($_SESSION['user']),'superviseurs'=>UserModel::getModel()->getSuperviseurs()]);
        }
        else {
            $this->action_error("Vous n'avez pas les droits pour accéder à cette page");

        }
    }

    public function action_exposant(){
        $this->render('exposant', ['stands' => StandModel::getModel()->getAllStand(), 'user' => unserialize($_SESSION['user'])]);
    }

    public function action_createSupervisor(){
        if(isset($_SESSION['user']) && unserialize($_SESSION['user'])->getRole() === Role::SUPERVISOR && isset($_POST['email']) && isset($_POST['password'])) {
            if(UserModel::getModel()->isSupervisor($_POST['email'])){
                $this->action_error("Cet email est déjà utilisé par un superviseur");
                return;
            }
            if(UserModel::getModel()->getUserByConnexionID($_POST['email']) != null){
                $this->action_error("Cet email est déjà utilisé par un utilisateur");
                return;
            }
            $this->initSupervisor($_POST['email'], $_POST['password']);
        }
        else {
            $this->action_error("Vous n'avez pas les droits d'éffectuer cette action");
        }
    }

    public function action_deleteSupervisor(){
        if(isset($_SESSION['user']) && unserialize($_SESSION['user'])->getRole() === Role::SUPERVISOR && isset($_POST['email']) && $_POST['email'] !== unserialize($_SESSION['user'])->getConnexionId()) {
            if(!UserModel::getModel()->isSupervisor($_POST['email'])){
                $this->action_error("Cet email n'est pas utilisé par un superviseur");
                return;
            }
            UserModel::getModel()->deleteSupervisor($_POST['email']);
            $this->render('gestion', ['stands' => StandModel::getModel()->getAllStand(), 'user' => unserialize($_SESSION['user']),'superviseurs'=>UserModel::getModel()->getSuperviseurs()]);
        }
        else {
            $this->action_error("Vous n'avez pas les droits d'éffectuer cette action ou erreur dans l'email");
        }
    }

    public function action_changeFirstName(){
        if(isset($_POST['name']) && unserialize($_SESSION['user'])->getRole() === Role::PROFESSOR){
            if(is_valid_name($_POST['name'])){
                $user = unserialize($_SESSION['user']);
                $pdata = $user->getPersonalData();
                $pdata['first_name'] = $_POST['name'];
                $user->setPersonalData($pdata);
                $user->save();
                $_SESSION['user'] = serialize($user);
                $this->action_my_account();
            }
            else {
                $this->action_error("Le nom n'est pas valide");
            }
        }
        else {
            $this->action_error("Vous n'avez pas les droits pour effectuer cette action");
        }
    }

    public function action_changeLastName(){
        if(isset($_POST['name']) && unserialize($_SESSION['user'])->getRole() === Role::PROFESSOR){
            if(is_valid_name($_POST['name'])){
                $user = unserialize($_SESSION['user']);
                $pdata = $user->getPersonalData();
                $pdata['last_name'] = $_POST['name'];
                $user->setPersonalData($pdata);
                $user->save();
                $_SESSION['user'] = serialize($user);
                $this->action_my_account();
            }
            else {
                $this->action_error("Le nom n'est pas valide");
            }
        }
        else {
            $this->action_error("Vous n'avez pas les droits pour effectuer cette action");
        }
    }

    public function action_changePhone(){
        if(isset($_POST['phone']) && unserialize($_SESSION['user'])->getRole() === Role::PROFESSOR){
            if(is_valid_phone($_POST['phone'])){
                $user = unserialize($_SESSION['user']);
                $pdata = $user->getPersonalData();
                $pdata['phone'] = $_POST['phone'];
                $user->setPersonalData($pdata);
                $user->save();
                $_SESSION['user'] = serialize($user);
                $this->action_my_account();
            }
            else {
                $this->action_error("Le numéro de téléphone n'est pas valide");
            }
        }
        else {
            $this->action_error("Vous n'avez pas les droits pour effectuer cette action");
        }
    }

    public function action_changeSchool(){
        if(isset($_POST['school']) && unserialize($_SESSION['user'])->getRole() === Role::PROFESSOR){
            $user = unserialize($_SESSION['user']);
            $pdata = $user->getPersonalData();
            $pdata['school'] = $_POST['school'];
            $user->setPersonalData($pdata);
            $user->save();
            $_SESSION['user'] = serialize($user);
            $this->action_my_account();
        }
        else {
            $this->action_error("Vous n'avez pas les droits pour effectuer cette action");
        }
    }

    public function action_changePass(){
        if(isset($_POST['old_pass']) && isset($_POST['pass']) && isset($_POST['pass_confirm'])){
            $user = unserialize($_SESSION['user']);
            if($_POST['pass'] === $_POST['pass_confirm']){
                if(password_verify($_POST['old_pass'], $user->getPassHash())){
                    $user->setPassHash(hash_pass($_POST['pass']));
                    $user->save();
                    $_SESSION['user'] = serialize($user);
                    $this->action_my_account();
                }
                else {
                    $this->action_error("L'ancien mot de passe est incorrect");
                }
            }
            else {
                $this->action_error("Les mots de passe ne correspondent pas");
            }
        }
        else {
            $this->action_error("Erreur dans les données envoyées");
        }
    }

    public function action_changeEmail(){
        if(isset($_POST['email']) && is_valid_email($_POST['email'])){
            if(isset($_POST['pass'])){
                $user = unserialize($_SESSION['user']);
                if(password_verify($_POST['pass'], $user->getPassHash())){
                    $user->setConnexionID($_POST['email']);
                    if($user->getRole() === Role::PROFESSOR && $user->getPersonalData() !== null){
                        $pdata = $user->getPersonalData();
                        $pdata['email'] = $_POST['email'];
                        $user->setPersonalData($pdata);
                    }
                    $user->save();
                    $_SESSION['user'] = serialize($user);
                    $this->action_my_account();
                }
                else {
                    $this->action_error("Le mot de passe est incorrect");
                }
            }
            else {
                $this->action_error("Le mot de passe est incorrect");
            }
        }
        else {
            $this->action_error("L'adresse email est incorrecte");
        }
    }

    /**
     * Action pour se connecter
     */
    public function action_sign_in(){
        if(isset($_POST['email'])){
            $mail = strtolower($_POST['email']);
            if(is_valid_email($mail) && isset($_POST['pass'])){
                $user = UserModel::getModel()->getUserByConnexionID($mail);
                if($user != null) {
                    if(password_verify($_POST['pass'], $user->getPassHash())){
                        $_SESSION['user'] = serialize($user);
                        if(isset($_POST['remember']) && $_POST['remember'] == "on"){
                            setcookie('user', serialize($user), time() + 3600 * 24 * 30, '/', '', true, true);
                        }
                        if(unserialize($_SESSION['user'])->getRole() === Role::PROFESSOR){
                            $this->action_my_account();
                        }
                        else {
                            $this->action_gestion();
                        }
                    }
                    else {
                        $this->action_error('Mot de passe incorrect');
                    }
                }
                else {
                    $this->action_error('Adresse mail inconnue');
                }
            }
            else {
                $this->action_error('Adresse mail ou mot de passe invalide');
            }
        }
        else {
            $this->action_error('Adresse mail non spécifiée');
        }
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
                isset($_POST['last_name']) && isset($_POST['first_name']) && isset($_POST['school']) && is_valid_name($_POST['last_name']) && is_valid_name($_POST['first_name']) && isset($_POST['cgu_accept']) && $_POST['cgu_accept'] === 'on'){

                if(CAPTCHA_ENABLED){
                    if(!isset($_POST['h-captcha-response'])){
                        $this->action_error('Captcha invalide');
                        return;
                    }
                    $secret = parse_ini_file("../hcaptcha.ini")['secret'];
                    $data = array(
                        'secret' => $secret,
                        'response' => $_POST['h-captcha-response']
                    );
                    // POST REQUEST TO CHECK THE VALIDITY OF THE CAPTCHA TOKEN

                    $options = array(
                        'http' => array(
                            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                            'method'  => 'POST',
                            'content' => http_build_query($data),
                        ),
                    );
                    $context  = stream_context_create($options);

                    // envoi de la requête de vérification à HCaptcha
                    $verify_url = 'https://hcaptcha.com/siteverify';
                    $result = file_get_contents($verify_url, false, $context);

                    // décodage du résultat de la requête
                    $responseData = json_decode($result);

                    if($responseData->success) {
                        if (UserModel::getModel()->getUserByConnexionID($mail) == null) {
                            $this->initUser($mail);
                        }
                    }
                    else {
                        $this->action_error('Erreur dans la vérification du Captcha');
                    }
                }
                elseif(UserModel::getModel()->getUserByConnexionID($mail) == null) {
                    $this->initUser($mail);
                }
                else {
                    $this->action_error("Adresse mail déjà utilisée");
                }
            }
            else {
                $this->action_error('Formulaire invalide');
            }
        }
        else {
            $this->action_error("Adresse mail non spécifiée");
        }
    }

    private function initUser($mail){
        $user = new User();
        $user->setID(UserModel::getModel()->getMaxID()+1);
        $user->setConnexionID($mail);
        $user->setActive(true);
        $user->setPassHash(hash_pass($_POST['pass']));
        $user->setRole(Role::PROFESSOR);
        $lastName = $_POST['last_name'];
        $firstName = $_POST['first_name'];
        $school = $_POST['school'];
        $pdata = ['last_name' => $lastName, 'first_name' => $firstName, 'email' => $mail, 'phone' => null, 'school' => $school];
        $user->setPersonalData($pdata);
        $user->save();
        $_SESSION['user'] = serialize($user);
        $this->action_my_account();
    }

    private function initSupervisor($mail, $pass){
        $user = new User();
        $user->setID(UserModel::getModel()->getMaxID()+1);
        $user->setConnexionID($mail);
        $user->setActive(true);
        $user->setPassHash(hash_pass($pass));
        $user->setRole(Role::SUPERVISOR);
        $user->save();
    }

}