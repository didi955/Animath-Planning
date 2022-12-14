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
       <span class="col-6 border-end pt-3" role="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <span>Connexion</span>
        </span>
        <span class="col-6 border-start pt-3" role="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            <span>Inscription</span>
        </span>
    </div>
</div>

<div class="accordion shadow" id="accordionExample">
    <div class="bg-light bg-gradient accordion-item accordion-collapse collapse pt-4" id="collapseOne" data-bs-parent="#accordionExample">
        <?php if(isset($_SESSION['user'])): ?>
        <div class="container text-center pt-3 pb-3 mt-3 mb-3">
            Vous êtes déja connécté : )
        </div>
        <?php else: ?>
        <form class="container needs-validation" method="post" action="?controller=User&action=sign_in" style="width: 35%" novalidate>
            <?php include "Layouts/connexion.php"?>
        </form>
        <?php endif; ?>
    </div>
    <div class="bg-light bg-gradient accordion-item accordion-collapse collapse pt-4" id="collapseTwo" data-bs-parent="#accordionExample">
        <form class="container needs-validation" method="post" action="?controller=User&action=sign_up" style="width: 35%" novalidate>
            <?php include "Layouts/inscriptionCollapse.php"?>
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


