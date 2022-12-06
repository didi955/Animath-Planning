
<div class="row align-items-center fixed-top position-absolute mt-2" style="width: 15%;left:85%;height: 10%" >
    <span class="col w-50 form-check-reverse form-switch text-center">
            <label for="darkMode"></label><input class="mx-1 form-check-input " type="checkbox" id="darkMode" role="switch">
    </span>
    <span class="col w-50">
        <img class="w-75 btn" data-bs-toggle="collapse" data-bs-target="#collapseMenu" role="button" aria-expanded="true" aria-controls="collapseMenu" src="public/images/avatar.png" alt="mon_compte">
    </span>
    <div class="collapse" id="collapseMenu">
        <div class="card card-body">
            <p class="text-center">Vous n'êtes pas connecté !</p>
            <span class="row">
            <button class="col border-right btn btn-light border m-1" data-bs-toggle="modal" href="#connexionModal">Connexion</button>
            <button class="col border-left btn btn-primary border m-1" data-bs-toggle="modal" href="#inscriptionModal">Inscription</button>
        </span>
        </div>
    </div>
</div>

<div class="modal fade" id="connexionModal" tabindex="-1" aria-labelledby="connexionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Connexion</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="container" action="?controller=User&action=sign_in" method="post">
                    <span class="row m-3">
                        <label class="col form-label" for="login">Identifiant/Mail :</label><input class="col form-control" type="email" id="login" required>
                    </span>
                    <span class="row m-3">
                        <label class="col form-label" for="password">Mot de passe : </label><input class="col form-control" type="password" id="password" required>
                    </span>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Se connecter"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="inscriptionModal" tabindex="-1" aria-labelledby="inscriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Inscription</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="container" method="get" action="?controller=User&action=sign_up">
                    <span class="row m-3">
                        <label class="col form-label" for="email">Mail :</label><input class="col form-control" type="email" id="email" required>
                    </span>
                    <span class="row m-3">
                        <label class="col form-label" for="last_name">Nom :</label><input class="col form-control" type="text" id="last_name" required>
                    </span>
                    <span class="row m-3">
                        <label class="col form-label" for="first_name">Prénom :</label><input class="col form-control" type="text" id="first_name" required>
                    </span>
                    <span class="row m-3">
                        <label class="col form-label" for="pass">Mot de passe : </label><input class="col form-control" type="password" id="pass" required>
                    </span>
                    <span class="row m-3">
                        <label class="col form-label" for="pass_confirm">Confirmation mot de passe : </label><input class="col form-control" type="password" id="pass_confirm" required>
                    </span>
                    <span class="row m-3">
                        <input type="checkbox" name="cgu_accept_ins" id="cgu"/><label for="cgu">J'accepte les <a href="#">Conditions Générales d'Utilisation</a></label>
                    </span>
                    <?php
                    /*
                    $key = parse_ini_file("hcaptcha.ini")['key'];
                    echo '<div class="h-captcha" data-sitekey="'. $key .'"></div>';
                    */
                    ?>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>