
<div class="row align-items-center fixed-top position-absolute mt-2" style="width: 15%;left:85%;height: 10%" >
    <span class="col w-50 form-check-reverse form-switch text-center">
            <input class="mx-1 form-check-input " type="checkbox" id="darkMode" role="switch">
    </span>
    <span class="col w-50">
        <img class="w-75 btn" data-bs-toggle="collapse" data-bs-target="#collapseMenu" role="button" aria-expanded="true" aria-controls="collapseMenu" src="public/images/avatar.png" alt="mon_compte">
    </span>
    <div class="collapse" id="collapseMenu">
        <div class="card card-body">
            <p class="text-center">Vous n'êtes pas connecté !</p>
            <span class="row">
            <button class="col border-right btn btn-light border m-1" data-bs-toggle="modal" href="#connexionModal">Connexion</button>
            <button class="col border-left btn btn-primary border m-1">Inscription</button>
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
                <form class="container">
                    <span class="row m-3">
                        <label class="col form-label" for="login">Identifiant/Mail :</label><input class="col form-control" type="email" id="login" required>
                    </span>
                    <span class="row m-3">
                        <label class="col form-label" for="password">Mot de passe : </label><input class="col form-control" type="password" id="password" required>
                    </span>
                    <?php
                    /*
                    $key = parse_ini_file("hcaptcha.ini")['key'];
                    echo '<div class="h-captcha" data-sitekey="'. $key .'"></div>';
                    */
                    ?>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Connexion</button>
            </div>
        </div>
    </div>
</div>