<?php
include 'view_topbar.php';
?>

<style>
    body {
        overflow-x: hidden;
        width: auto;
        height: auto;
        background: url("public/images/AnimathBlur.png") no-repeat fixed center center;
    }
</style>

<div class="border-bottom mt-3 mb-3">
    <div class="container pt-3 pb-3 text-center">
        <div class="row">
            <div class="col-12">
                <h1>Mon compte</h1>
            </div>
        </div>
    </div>
</div>

<div class="container shadow border text-center">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#accordionInfoPerso">Info Perso</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
        </li>
    </ul>

    <div class="accordion m-3" id="accordionInfoPerso">
        <div class="accordion-item">
            <h2 class="accordion-header" id="HeaderPanelMail">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#PanelMail" aria-expanded="true" aria-controls="PanelMail">
                    Adresse Mail
                </button>
            </h2>
            <div id="PanelMail" class="accordion-collapse collapse show" aria-labelledby="HeaderPanelMail">
                <div class="accordion-body row">
                    <div class="col-1">
                        Mail :
                    </div>
                    <div class="col-10 text-center">
                        <strong> <?= e($user->getEmail()) ?> </strong>
                    </div>
                    <div class="col-1">
                        <div class="h-50">
                            <img class="w-25" src="public/images/modif.png" alt="modif">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="HeaderPanelLastName">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#PanelLastName" aria-expanded="true" aria-controls="PanelLastName">
                    Nom
                </button>
            </h2>
            <div id="PanelLastName" class="accordion-collapse collapse show" aria-labelledby="HeaderPanelLastName">
                <div class="accordion-body row">
                    <div class="col-1">
                        Nom :
                    </div>
                    <div class="col-10">
                        <strong><?= e($user->getLastName()) ?></strong>
                    </div>
                    <div class="col-1">
                        <div class="h-50">
                            <img class="w-25" src="public/images/modif.png" alt="modif">
                        </div>
                    </div>
                </div>
                <div class="accordion-body row">
                    <div class="col-1">
                        Prénom :
                    </div>
                    <div class="col-10">
                        <strong><?= e($user->getFirstName()) ?></strong>
                    </div>
                    <div class="col-1">
                        <div class="h-50">
                            <img class="w-25" src="public/images/modif.png" alt="modif">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="HeaderPanelRole">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#PanelRole" aria-expanded="true" aria-controls="PanelRole">
                    Role
                </button>
            </h2>
            <div id="PanelRole" class="accordion-collapse collapse show" aria-labelledby="HeaderPanelRole">
                <div class="accordion-body row">
                    <div class="col-1">
                        Role :
                    </div>
                    <div class="col-10">
                        <strong><?= e($user->getRole()->name) ?></strong>
                    </div>
                    <div class="col-1">
                        <div class="h-50">
                            <img class="w-25" src="public/images/modif.png" alt="modif">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="position-absolute bottom-0 w-100">
    <?php
    include 'view_footer.php';
    ?>
</div>