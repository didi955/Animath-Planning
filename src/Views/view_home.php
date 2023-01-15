<?php
include "view_topbar.php";
?>

<style>
    body {
        background: url("public/images/main-logo2.png") no-repeat fixed center center;
        background-color : #019EE3;
    }
</style>


<div class="w-100" style="height: 70%"></div>

<div class="row w-100 text-center" style="height: 15%">
    <div class="col-2"></div>
    <div class="container col-2">
        <div class="h-100 w-100 fs-4 text-white shadow-lg rounded-2 d-flex justify-content-center align-items-center" role="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" onclick="setTimeout(()=>window.scrollTo(0, 3000),330)" style="background-color: #007ea7">
            <p class="pb-1"> Je suis professeur</p>
        </div>
    </div>
    <div class="col-4"></div>

    <div class="container col-2">
        <a class="text-decoration-none h-100 w-100 fs-4 text-white shadow-lg rounded-2 d-flex justify-content-center align-items-center" href="?controller=User&action=exposant" style="background-color: #007ea7">
            <p class="pb-1"> Je suis exposant</p>
        </a>
    </div>
    <div class="col-2"></div>
</div>
<div class="w-100" style="height: 10% "></div>
<div class="w-100  border-bottom strong bg-light" style="height: 5%"></div>
<div class="row collapse " style="background-color: #89dafe;" id="collapseOne">

    <div class=" bg-gradient pt-4 col-6 border-end">
        <div class="text-center fs-3 pb-3">Connexion</div>
        <?php if(isset($_SESSION['user'])): ?>
        <div class="container text-center pt-3 pb-3 mt-3 mb-3 fs-5">
            Vous êtes déjà connecté
            <br><br>
            <?php if(unserialize($_SESSION['user'])->getRole() === Role::SUPERVISOR): ?>
                <a class="btn btn-primary btn-lg" href="?controller=User&action=gestion">Gestion</a>
            <?php else: ?>
                <a class="btn btn-primary btn-lg" href="?controller=User&action=my_account">Mon compte</a>
            <?php endif; ?>
        </div>
        <?php else: ?>
        <form class="container needs-validation w-75" method="post" action="?controller=User&action=sign_in" novalidate>
            <?php include "Layouts/connexion.php"?>
        </form>
        <?php endif; ?>
    </div>
    <div class=" bg-gradient col-6 pt-4 border-start">
        <div class="text-center fs-3 pb-3">Inscription</div>
        <form class="container needs-validation w-75" method="post" action="?controller=User&action=sign_up" novalidate>
            <?php include "Layouts/inscriptionCollapse.php"?>
        </form>
    </div>
</div>

<div class="modal fade" id="cguModalHome" tabindex="-1" aria-labelledby="cguModalLabel" aria-hidden="true">
    <?php
    include_once "view_legal.php";
    ?>
</div>

