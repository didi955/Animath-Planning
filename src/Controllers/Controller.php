<?php

abstract class Controller
{
    /**
     * Constructeur. Lance l'action correspondante
     */
    public function __construct()
    {

        //On détermine s'il existe dans l'url un paramètre action correspondant à une action du contrôleur
        if (isset($_GET['action']) and method_exists($this, "action_" . $_GET["action"])) {
            //Si c'est le cas, on appelle cette action
            $action = "action_" . $_GET["action"];
            $this->$action();
        } else {
            //Sinon, on appelle l'action par défaut
            $this->action_default();
        }
    }

    /**
     * Action par défaut du contrôleur (à définir dans les classes filles)
     */
    abstract public function action_default();

    /**
     * Affiche la vue
     * @param string $vue nom de la vue
     * @param array $data tableau contenant les données à passer à la vue
     * @return aucun
     */
    protected function render($vue, $data = [])
    {

        //On extrait les données à afficher
        extract($data);

        //On teste si la vue existe
        $file_name = "Views/view_" . $vue . '.php';
        if (file_exists($file_name)) {
            include $file_name;
        } else {
            $this->action_error("La vue n'existe pas !", 404);
        }
        die();
    }

    /**
     * Méthode affichant une page d'erreur
     * @param string $message Message d'erreur à afficher
     * @return
     */
    protected function action_error(string $message = '', $code = 500): void
    {
        $data = [
            'title' => "Error",
            'code' => $code,
            'message' => $message
        ];
        $this->render("error", $data);
    }
}