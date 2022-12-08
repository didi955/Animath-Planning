<?php
include "view_topbar.php";
?>

<style>
    body {
        overflow-x: hidden;
        width: auto;
        height: auto;
        background: url("public/images/Animath.jpg") no-repeat fixed center center;
    }
</style>

<div class="w-100" style="height: 93%"></div>


<div class="card bg-light" style="height: 7%">
    <div class="row text-center fs-5 h-100">
       <span class="col-6 border-end pt-3">
            <span role="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Connexion</span>
        </span>
        <span class="col-6 border-start pt-3">
            <span role="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Inscription</span>
        </span>
    </div>
</div>

<div class="accordion shadow" id="accordionExample">
    <div class="bg-light bg-gradient accordion-item accordion-collapse collapse pt-4" id="collapseOne" data-bs-parent="#accordionExample">
        <form class="container" action="?controller=User&action=sign_in" method="post" style="width: 35%">
            <div class="mb-3">
                <label class="col form-label" for="login">Identifiant/Mail :</label><input class="col form-control" type="email" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label class="col form-label" for="password">Mot de passe : </label><input class="col form-control" type="password" id="pass" name="pass" required>
            </div>
            <div class="mb-3">
                <input type="checkbox" name="remember_ont" id="remember" class="form-check-input"/>
                <label for="remember" class="form-check-label">Se souvenir de moi</label>
            </div>
            <div class="mb-3">
                <input class="col btn btn-primary" type="submit" value="Se connecter">
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" value="Se connecter"/>
            </div>
        </form>
    </div>

    <div class="bg-light bg-gradient accordion-item accordion-collapse collapse pt-4" id="collapseTwo" data-bs-parent="#accordionExample">
        <form class="container needs-validation" method="post" action="?controller=User&action=sign_up" style="width: 35%" novalidate>
            <div class="mb-3">
                <label class="form-label" for="email">Mail :</label>
                <input class="form-control" type="email" id="email" name="email" required>
                <div class="invalid-feedback">Veuillez entrer une adresse mail valide.</div>
                <div class="valid-feedback">Adresse mail valide.</div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="first_name">Prénom :</label>
                <input class="form-control" type="text" id="first_name" name="first_name" required>
                <div class="invalid-feedback">Veuillez entrer un prénom valide.</div>
                <div class="valid-feedback">Prénom valide.</div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="last_name">Nom :</label>
                <input class="form-control" type="text" id="last_name" name="last_name" required>
                <div class="invalid-feedback">Veuillez entrer un nom valide.</div>
                <div class="valid-feedback">Nom valide.</div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="pass">Mot de passe : </label>
                <input class="form-control" type="password" id="pass" name="pass" required>
                <div class="invalid-feedback">Veuillez entrer un mot de passe valide.</div>
                <div class="valid-feedback">Mot de passe valide.</div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="pass_confirm">Confirmation mot de passe : </label>
                <input class="form-control" type="password" id="pass_confirm" name="pass_confirm" required>
                <div class="invalid-feedback">Veuillez entrer un mot de passe valide.</div>
                <div class="valid-feedback">Mot de passe valide.</div>
            </div>
            <div class="mb-3">
                <input type="checkbox" name="cgu_accept" id="cgu" class="form-check-input"/>
                <label for="cgu">J'accepte les <a data-bs-toggle="modal" href="#cguModalFooter"><?=e(CGU_TITLE)?></a></label>
                <div class="invalid-feedback">Veuillez accepter les CGU, pour continuer</div>
            </div>
            <?php
            /*
            $key = parse_ini_file("hcaptcha.ini")['key'];
            echo '<div class="h-captcha" data-sitekey="'. $key .'"></div>';
            */
            ?>
            <div class="modal-footer">
                <input type="submit" id="submit_signup" class="btn btn-primary" value="Envoyer"/>
            </div>
        </form>
    </div>
</div>

    <div class="container border shadow ps-5 pt-5 pb-5 text-center bg-white">
        <div class="row w-100 mb-2" style="height: 20%">
            <div class="col-md-9 h-100 pt-5"> Lorem Ispum dolor sit amet, Lorem Ispum dolor sit amet, Lorem Ispum dolor sit amet, Lorem Ispum dolor sit amet, Lorem Ispum dolor sit amet,</div>
            <div class="col-md-3 h-100 bg-light"> Image </div>
        </div>
        <div class="row w-100 mb-2" style="height: 20%">
            <div class="col-md-3 h-100 bg-light"> Image </div>
            <div class="col-md-9 h-100 pt-5">Lorem Ispum dolor sit amet, Lorem Ispum dolor sit amet, Lorem Ispum dolor sit amet, Lorem Ispum dolor sit amet, Lorem Ispum dolor sit amet,</div>
        </div>
        <div class="row w-100 mb-2" style="height: 20%">
            <div class="col-md-9 h-100 pt-5">Lorem Ispum dolor sit amet, Lorem Ispum dolor sit amet, Lorem Ispum dolor sit amet, Lorem Ispum dolor sit amet, Lorem Ispum dolor sit amet,</div>
            <div class="col-md-3 h-100 bg-light"> Image </div>
        </div>
        <div class="row w-100 mb-2" style="height: 20%">
            <div class="col-md-3 h-100 bg-light"> Image </div>
            <div class="col-md-9 h-100 pt-5">Lorem Ispum dolor sit amet, Lorem Ispum dolor sit amet, Lorem Ispum dolor sit amet, Lorem Ispum dolor sit amet, Lorem Ispum dolor sit amet, </div>
        </div>
    </div>

<?php
include "view_footer.php";
?>


