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
        <div class="h-100 w-100 fs-4 text-white shadow-lg rounded-2 d-flex justify-content-center align-items-center" style="background-color: #007ea7">
            <p class="pb-1"> Je suis exposant</p>
        </div>
    </div>

    <div class="col-2"></div>
</div>
<div class="w-100" style="height: 10%"></div>
<div class="w-100 bg-light border-bottom" style="height: 5%"></div>
<!-- <div class="card bg-light" style="height: 7%">
    <div class="row text-center fs-5 h-100">
        <span class="col-6 border-end pt-3" role="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" onclick="setTimeout(()=>window.scrollTo(0, 2000),250)">
            <span>Connexion</span>
        </span>
        <span class="col-6 border-start pt-3" role="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" onclick="setTimeout(()=>window.scrollTo(0, 2000),300)">
            <span>Inscription</span>
        </span>
    </div>
</div> -->

<div class="row collapse" id="collapseOne">

    <div class="bg-light bg-gradient pt-4 col-6 border-end">
        <div class="text-center fs-3 pb-3">Connexion</div>
        <?php if(isset($_SESSION['user'])): ?>
        <div class="container text-center pt-3 pb-3 mt-3 mb-3">
            Vous êtes déja connécté :)
        </div>
        <?php else: ?>
        <form class="container needs-validation w-75" method="post" action="?controller=User&action=sign_in" novalidate>
            <?php include "Layouts/connexion.php"?>
        </form>
        <?php endif; ?>
    </div>
    <div class="bg-light bg-gradient col-6 pt-4 border-start">
        <div class="text-center fs-3 pb-3">Inscription</div>
        <form class="container needs-validation w-75" method="post" action="?controller=User&action=sign_up" novalidate>
            <?php include "Layouts/inscriptionCollapse.php"?>
        </form>
    </div>
</div>

